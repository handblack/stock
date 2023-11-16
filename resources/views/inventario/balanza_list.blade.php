@extends('layouts.app')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables-scroller/css/scroller.bootstrap4.min.css') }}">    
@endpush

@push('script')
<script src="{{ asset('plugins/datatables-scroller/js/scroller.bootstrap4.min.js') }}"></script>
@endpush

@push('style')
<style>
.table-sm td {
    padding: 0.1rem;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 float-right">
        {{ $result->links('layouts.paginate') }}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="font-size:0.85rem;">
            <div class="card-body table-responsive p-0">
                <table id="table-balanza" class="display nowrap table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PESAJE ID</th>
                            <th>FECHA ING</th>
                            <th>FECHA LOCAL</th>
                            <th>CLIENTE</th>
                            <th>PROD</th>
                            <th>COLOR</th>
                            <th>CODIGO</th>
                            <th>ANCHO</th>
                            <th>REND</th>
                            <th>NET</th>
                            <th>HILADO</th>
                            <th>OP</th>
                            <th>PARTIDA</th>
                            <th>LOCAL</th>
                            <th>CANTIDAD</th>
                            <th>ROLLOS</th>
                            <th>PESO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($result as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->pesaje_id }}</td>
                                <td>{{ $item->fecha_ingreso->format('d/m/Y') }}</td>
                                <td>{{ $item->fecha_local->format('d/m/Y') }}</td>
                                <td>{{ $item->idcliente }}</td>
                                <td>{{ $item->producto }}</td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->codigo }}</td>
                                <td>{{ $item->ancho }}</td>
                                <td class="text-right text-monospace pr-2">{{ $item->rendimiento }}</td>
                                <td>{{ $item->net }}</td>
                                <td>{{ $item->hilado }}</td>
                                <td>{{ $item->operacion }}</td>
                                <td>{{ $item->partida }}</td>
                                <td>{{ $item->local }}</td>
                                <td>{{ $item->cantidad }}</td>
                                <td>{{ $item->rollo }}</td>
                                <td class="text-right text-monospace">{{ $item->peso }}</td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 float-right">
        {{ $result->links('layouts.paginate') }}
    </div>
</div>
<br>
@endsection

@push('script')
<script>
new DataTable('#table-balanza', {
    scrollX: true
});

</script>
@endpush