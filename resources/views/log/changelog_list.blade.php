@extends('layouts.app', ['sidebar' => '_sidebar-sistema'])

@push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-random fa-fw"></i> ChangeLog </h1>
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
                                        {{--
                                            
                                        <a href="{{ route('changelog.create') }}" class="btn btn-success"><i
                                                class="far fa-plus-square fa-fw"></i> NUEVO</a>
                                        --}}
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
                        <th width="180">FECHA</th>
                        <th width="150">TABLA</th>
                        <th width="70">CRUD</th>
                        <th>USUARIO</th>
                        <th>ID1:ID2</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($result as $item)
                        <tr>
                            <td class="">{{ $item->created_at }}</td>
                            <td class="">{{ $item->module }}</td>
                            <td class="">{{ $item->action }}</td>
                            <td class="">{{ $item->usuario_id ? $item->vusuario->usuario : '' }}</td>
                            <td class="text-monospace">{{ $item->record_id1 }}:{{ $item->record_id2 }}</td>
                            <td class="text-right">
                                <a href="#" onclick="showinfo({{ $item->id }});return false;" data-id="{{ $item->id }}"  data-url="{{ route('changelog.show',$item->id) }}" data-toggle="modal" data-target="#ModalInfoChangeLog">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                No hay registros!!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $result->links('layouts.paginate') }}
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ModalInfoChangeLog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="detalleajax">
                <div class="modal-body">
                    Cargando información ...
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
function showinfo(id){
    $.ajax({
        type: "GET",
        url: '{{ route('changelog.index') }}/' + id,        
        dataType: "text",
        success : function(data) {
                $("#detalleajax").html(data);
        }
    });
}
</script>
@endpush