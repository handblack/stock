@extends('layouts.app')

@section('content')
    Descargar movimientos
    <form action="{{ route('index_submit_move') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_module" value="move">
        <div class="card">
            <div class="card-body">
                <input type="text" name="dateinit">
                <input type="text" name="dateend">
                <button type="submit">Consultar</button>
            </div>
        </div>

    </form>

    
@endsection
