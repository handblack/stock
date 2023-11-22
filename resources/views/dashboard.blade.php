@extends('layouts.app')

@section('content')
    {{ env('DB_HOST') }} 
    {{ env('DB_DATABASE') }}
@endsection