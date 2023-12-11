<?php

namespace App\Http\Controllers;

use App\Models\WhLogChange;
use Illuminate\Http\Request;
//use Telegram\Bot\Api;

class ChangeLogController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = '';    
        $result = WhLogChange::orderBy('id','desc')
                            ->paginate(env('PAGINATE',20))
                            ->withQueryString();
        //$telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        //$updates = $telegram->getUpdates();
        return view('log.changelog_list',[
            'result' => $result,
            'q' => $q,
            //'u' => $updates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = WhLogChange::whereId($id)->first();
        $r1 = (array)$row->datasource;
        $r2 = (array)$row->datachange;
        $r3 = array_diff($r1,$r2);
        foreach($r1 as $k => $v){$c['r1'][$k] = $v;}
        foreach($r2 as $k => $v){$c['r2'][$k] = $v;}        
        return view('log.changelog_show',[
            'row'   => $row,
            'id'    => $id,
            'r1'    => $r1,
            'r2'    => $r2,
            'r3'    => $r3,
            'c'     => $c
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
