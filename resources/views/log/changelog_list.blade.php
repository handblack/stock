@extends('layouts.app',['sidebar' => '_sidebar-sistema'])

@push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-file-alt fa-fw"></i> ChangeLog </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Log</a></li>
                        <li class="breadcrumb-item">ChangeLog</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="content-header pt-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <form action="{{ route('changelog.index') }}" method="GET">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <a href="#" onclick="location.reload()" class="btn btn-secondary mr-2"><i
                                        class="fas fa-sync-alt fa-fw"></i></a>
                            </div>
                            <div class="btn-groun">
                                <div class="input-group input-group">
                                    <input type="text" name="q" value="{{ $q }}"
                                        class="form-control float-right" placeholder="Buscar..." autofocus>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ route('changelog.create') }}" class="btn btn-success"><i
                                                class="far fa-plus-square fa-fw"></i> NUEVO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mt-2">
                    {{ $result->links('layouts.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th width="65"></th>
                    <th>Nombre del documento</th>
                    <th>Codigo</th>
                    <th class="text-center" width="100">GRP</th>
                    <th width="90"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($result as $item)
                    <tr>
                        <td class="text-monospace">{{ $item->shortname }}</td>
                        <td class="text-monospace">{{ $item->doctypename }}</td>
                        <td class="text-monospace">{{ $item->doctypecode }}</td>
                        <td class="text-center">
                            @switch($item->group_id)
                                @case(1)
                                    <i class="far fa-address-card fa-fw"></i>
                                    @break
                                @case(2)
                                    <i class="far fa-file-alt fa-fw"></i>
                                    @break
                                @case(3)
                                    <i class="fas fa-cubes fa-fw"></i>
                                    @break
                                @case(4)
                                    <i class="fab fa-windows fa-fw"></i>
                                    @break
                                @default
                                    
                            @endswitch
                        </td>
                        <td class="text-right border-left">
                            @if(!in_array($item->group_id,[3,4]))
                                <a href="{{ route('doctype.edit', $item->token) }}">
                                    <i class="far fa-edit"></i>
                                </a>
                                &nbsp;|&nbsp;
                                <a href="#" class="delete-record" data-id="{{ $item->id }}"
                                    data-url="{{ route('doctype.destroy', $item->token) }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            @else
                            <i class="far fa-edit"></i>
                            &nbsp;|&nbsp;
                            <i class="far fa-trash-alt"></i>
                            @endif
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection