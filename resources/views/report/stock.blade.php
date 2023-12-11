@extends('layouts.app')

@section('content')

    Descargar Stock
    <form action="{{ route('index_submit_stock') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_module" value="stock">
        <div class="card">
            <div class="card-body">
                <input type="date" name="dateend" value="{{ date('Y-m-d') }}">
                <button type="submit">Descagar STOCK</button>
            </div>
        </div>
    </form>
@endsection
