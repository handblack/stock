<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function stock(){
        return view('report.stock');
    }

    public function movimiento(){
        return view('report.movimiento');
    }

    public function index_submit_move(Request $request){
        $request->validate([
            '_module' => 'required',
        ]);
        switch($request->_module){
            case 'stock':

                break;
        }
    }

    public function index_submit_stock(Request $request){
        $request->validate([
            'dateend'   => 'required',
        ]);

        return response()->streamDownload(function () use ($request) {
            $title = 'stock_'.Carbon::parse($request->dateend)->format('d_m_Y');
            $spreadsheet = new Spreadsheet;
            $sheet       = $spreadsheet->getActiveSheet();
            $sheet->setTitle($title);
            $sheet->setCellValue('A1', 'CODIGO');
            $sheet->setCellValue('B1', 'PRODUCTO');
            $spreadsheet->setActiveSheetIndexByName($title);
            (new Xlsx($spreadsheet))->save('php://output');            
        }, 'rpt_stock_'.date("Ymd_His").'.xlsx');
    }

    public function descargar_excel(Request $request){
        $request->validate([
            'dateinit' => 'required',
            'dateend' => 'required',
        ]);

        return response()->streamDownload(function () use ($request) {
            $dateinit = $request->dateinit;
            $dateend = $request->dateend;

            $spreadsheet = new Spreadsheet;
            $sheet       = $spreadsheet->getActiveSheet();
            $sheet->setTitle('resumen2');
            $sheet->setCellValue('A1', 'Empresa ('.Carbon::parse($dateinit)->format('d/m/Y').' hasta '.Carbon::parse($dateend)->format('d/m/Y').')');
            $sheet->setCellValue('B1', 'Anticipo');
            $sheet->setCellValue('C1', 'Comisiones');
            $sheet->setCellValue('D1', 'IGV');
            $sheet->setCellValue('E1', 'T.Retencion');
            $sheet->setCellValue('F1', 'Prestamos');
            $sheet->setCellValue('G1', 'Cuota Capital');
            $sheet->setCellValue('H1', 'Interes');
            $sheet->setCellValue('I1', 'IGV');
            $sheet->setCellValue('J1', 'T.Retencion');
            $sheet->setCellValue('L1', 'CASHOUT');
            $sheet->setCellValue('M1', 'CASHIN-TOT');
            $sheet->setCellValue('N1', 'CASHIN-PEND');
            $sheet->getStyle('A1:N1')->applyFromArray(['font' => ['bold' => true]]);
            $sheet->getStyle('B1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFCC81');
            $sheet->getStyle('F1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('A9FF9C');
            $sheet->getStyle('L1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C3CFFF');
            $sheet->getStyle('M1:N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E3F5FF');
            $result = DB::select("CALL rpt2_totales(?,?)",[Carbon::parse($dateinit),Carbon::parse($dateend)]);
            $key = 2;
            $a1 = 0;
            $a2 = 0;
            $a3 = 0;
            $at = 0;
            $b1 = 0;
            $b2 = 0;
            $b3 = 0;
            $b4 = 0;
            $bt = 0;
            $rta = 0;
            $rtc = 0;
            foreach($result as $row){
                $sheet->setCellValue("A$key", $row->nombre);
                $sheet->setCellValue("B$key", round($row->A1,2));
                $sheet->setCellValue("C$key", round($row->A2,2));
                $sheet->setCellValue("D$key", round($row->A3,2));
                $sheet->setCellValue("E$key", round($row->AT,2));
                $sheet->setCellValue("F$key", round($row->B1,2));
                $sheet->setCellValue("G$key", round($row->B2,2));
                $sheet->setCellValue("H$key", round($row->B3,2));
                $sheet->setCellValue("I$key", round($row->B4,2));
                $sheet->setCellValue("J$key", round($row->BT,2));
    
                $sheet->setCellValue("L$key", round($row->A1 + $row->B1,2));
                $sheet->setCellValue("M$key", round($row->AT + $row->BT,2));
                $sheet->setCellValue("N$key", round($row->RTA + $row->RTC,2));
                $sheet->getStyle("B{$key}:N{$key}")->getNumberFormat()->setFormatCode('_-* #,##0.00_-;-* #,##0.00_-;_-* "-"??_-;_-@_-');
                $key++;
                $a1 = $a1 + $row->A1;
                $a2 = $a2 + $row->A2;
                $a3 = $a3 + $row->A3;
                $at = $at + $row->AT;
                $b1 = $b1 + $row->B1;
                $b2 = $b2 + $row->B2;
                $b3 = $b3 + $row->B3;
                $b4 = $b4 + $row->B4;
                $bt = $bt + $row->BT;
                $rta = $rta + $row->RTA;
                $rtc = $rtc + $row->RTC;
            }
            //TOTALES
            $sheet->setCellValue("B$key", round($a1,2));
            $sheet->setCellValue("C$key", round($a2,2));
            $sheet->setCellValue("D$key", round($a3,2));
            $sheet->setCellValue("E$key", round($at,2));
            $sheet->setCellValue("F$key", round($b1,2));
            $sheet->setCellValue("G$key", round($b2,2));
            $sheet->setCellValue("H$key", round($b3,2));
            $sheet->setCellValue("I$key", round($b4,2));
            $sheet->setCellValue("J$key", round($bt,2));
            $sheet->setCellValue("L$key", round($a1 + $b1,2));
            $sheet->setCellValue("M$key", round($at + $bt,2));
            $sheet->setCellValue("N$key", round($rta + $rtc,2));

            $sheet->getStyle("B{$key}:J{$key}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E4E4E4');
            $sheet->getStyle("L{$key}:N{$key}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E4E4E4');
            $sheet->getStyle("B{$key}:N{$key}")->applyFromArray(['font' => ['bold' => true]]);
            //$sheet->getStyle("B{$key}:M{$key}")->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle("B{$key}:N{$key}")->getNumberFormat()->setFormatCode('_-* #,##0.00_-;-* #,##0.00_-;_-* "-"??_-;_-@_-');
            
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setWidth(12);
            $sheet->getColumnDimension('C')->setWidth(12);
            $sheet->getColumnDimension('D')->setWidth(12);
            $sheet->getColumnDimension('E')->setWidth(12);
            $sheet->getColumnDimension('F')->setWidth(12);
            $sheet->getColumnDimension('G')->setWidth(12);
            $sheet->getColumnDimension('H')->setWidth(12);
            $sheet->getColumnDimension('I')->setWidth(12);
            $sheet->getColumnDimension('J')->setWidth(12);
            $sheet->getColumnDimension('L')->setWidth(12);
            $sheet->getColumnDimension('M')->setWidth(13);
            $sheet->getColumnDimension('N')->setWidth(13);
            /*
                cashout
            */
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('cashout2');
            $sheet->setCellValue('A1', 'Colaborador');
            $sheet->setCellValue('B1', 'Empresa');
            $sheet->setCellValue('C1', 'Tipo');
            $sheet->setCellValue('D1', 'Base');
            $sheet->setCellValue('E1', 'Comisión');
            $sheet->setCellValue('F1', 'IGV');
            $sheet->setCellValue('G1', 'Total');
            $sheet->setCellValue('H1', 'Pagado');
            $sheet->setCellValue('I1', 'Boleta');
            $sheet->getStyle('A1:I1')->applyFromArray(['font' => ['bold' => true]]);
            $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C3CFFF');

            $key = 2;
            $b1 = 0;
            $b2 = 0;
            $b3 = 0;
            $b4 = 0;
            $result = DB::select("CALL rpt2_totales_cashout(?,?)",[Carbon::parse($dateinit),Carbon::parse($dateend)]);
            foreach($result as $row){
                $sheet->setCellValue("A$key", $row->empleado);
                $sheet->setCellValue("B$key", $row->empresa);
                $sheet->setCellValue("C$key", $row->modulo);
                $sheet->setCellValue("D$key", $row->imp_solicitado);
                $sheet->setCellValue("E$key", $row->imp_interes);
                $sheet->setCellValue("F$key", $row->imp_impuesto);
                $sheet->setCellValue("G$key", $row->imp_retencion);
                $sheet->setCellValue("H$key", $row->pagado_at);
                $sheet->setCellValue("I$key", $row->comprobante);
                $key++;
                $b1 = $b1 + $row->imp_solicitado;
                $b2 = $b2 + $row->imp_interes;
                $b3 = $b3 + $row->imp_impuesto;
                $b4 = $b4 + $row->imp_retencion;
            }
            $sheet->setCellValue("D$key", round($b1,2));
            $sheet->setCellValue("E$key", round($b2,2));
            $sheet->setCellValue("F$key", round($b3,2));
            $sheet->setCellValue("G$key", round($b4,2));
            $sheet->getStyle("D{$key}:G{$key}")->applyFromArray(['font' => ['bold' => true]]);
            $sheet->getStyle("D2:G{$key}")->getNumberFormat()->setFormatCode('_-* #,##0.00_-;-* #,##0.00_-;_-* "-"??_-;_-@_-');
            $sheet->getStyle("D{$key}:G{$key}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E4E4E4');
            $cols = ['A','B','C','H','I'];
            foreach($cols as $col){
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            $cols = ['D','E','F','G'];
            foreach($cols as $col){
                $sheet->getColumnDimension($col)->setWidth(12);
            }
            /*
                cashin
            */
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle('cashin2');
            $sheet->setCellValue('A1', 'Colaborador');
            $sheet->setCellValue('B1', 'Empresa');
            $sheet->setCellValue('C1', 'TRX');
            $sheet->setCellValue('D1', 'Tipo');
            $sheet->setCellValue('E1', 'Base');
            $sheet->setCellValue('F1', 'Comision');
            $sheet->setCellValue('G1', 'IGV');
            $sheet->setCellValue('H1', 'Total');
            $sheet->setCellValue('I1', 'Solicitado');
            $sheet->setCellValue('J1', 'Firmado');
            $sheet->setCellValue('K1', 'Pagado');
            $sheet->setCellValue('L1', 'Retener');
            $sheet->setCellValue('M1', 'Retenido');
            $sheet->getStyle('A1:M1')->applyFromArray(['font' => ['bold' => true]]);
            $sheet->getStyle('A1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E3F5FF');
            
            $key = 2;
            $b1 = 0;
            $b2 = 0;
            $b3 = 0;
            $b4 = 0;
            $result = DB::select("CALL rpt2_totales_cashin(?,?)",[Carbon::parse($dateinit),Carbon::parse($dateend)]);
            foreach($result as $row){
                $trx = str_pad(($row->modulo == 'ANTICIPO') ? $row->anticipo_id : $row->cuota_id, 4, "0", STR_PAD_LEFT);
                $sheet->setCellValue("A$key", $row->empleado);
                $sheet->setCellValue("B$key", $row->empresa);
                $sheet->setCellValue("C$key", ($row->modulo == 'ANTICIPO') ? "A{$trx}" : "C{$trx}");
                $sheet->setCellValue("D$key", $row->modulo);
                $sheet->setCellValue("E$key", $row->imp_solicitado);
                $sheet->setCellValue("F$key", $row->imp_interes);
                $sheet->setCellValue("G$key", $row->imp_impuesto);
                $sheet->setCellValue("H$key", $row->imp_retencion);
                $sheet->setCellValue("I$key", $row->created_at);
                $sheet->setCellValue("J$key", $row->contrato_firmado);
                $sheet->setCellValue("K$key", $row->pagado_at);
                $sheet->setCellValue("L$key", $row->retener_at);
                $sheet->setCellValue("M$key", $row->retenido_at);
                $key++;
                $b1 = $b1 + $row->imp_solicitado;
                $b2 = $b2 + $row->imp_interes;
                $b3 = $b3 + $row->imp_impuesto;
                $b4 = $b4 + $row->imp_retencion;
            }
            $sheet->setCellValue("E$key", round($b1,2));
            $sheet->setCellValue("F$key", round($b2,2));
            $sheet->setCellValue("G$key", round($b3,2));
            $sheet->setCellValue("H$key", round($b4,2));
            $sheet->getStyle("E{$key}:H{$key}")->applyFromArray(['font' => ['bold' => true]]);
            $sheet->getStyle("E2:H{$key}")->getNumberFormat()->setFormatCode('_-* #,##0.00_-;-* #,##0.00_-;_-* "-"??_-;_-@_-');
            $sheet->getStyle("E{$key}:H{$key}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E4E4E4');

            $cols = ['A','B','C','D','I','J','K','L','M'];
            foreach($cols as $col){
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            $cols = ['E','F','G','H'];
            foreach($cols as $col){
                $sheet->getColumnDimension($col)->setWidth(12);
            }


            $spreadsheet->setActiveSheetIndexByName('resumen2');
            (new Xlsx($spreadsheet))->save('php://output');            
        }, 'rpt_move_'.date("Ymd_His").'.xlsx');

    }



}
