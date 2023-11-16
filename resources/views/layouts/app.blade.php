<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="notranslate" translate="no">
    <head>
        <meta charset="UTF-8">
        <meta name="google" content="notranslate">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <title>Stock</title>
        @stack('css')
        @stack('header')
        @stack('style')
        <style>
        thead{
            background-color: #dfe1ee;
            border-bottom: 1px solid rgb(184, 184, 184);
        }
[class*=sidebar-dark] .nav-legacy .nav-treeview>.nav-item>.nav-link.active, 
[class*=sidebar-dark] .nav-legacy .nav-treeview>.nav-item>.nav-link:focus, 
[class*=sidebar-dark] .nav-legacy .nav-treeview>.nav-item>.nav-link:hover {
    background-color: #3b589882;
    color: #fff;
}
.navbar-nav .nav-link.active {
    background-color: #d8dfea;
    border-radius: 5px;
}
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        @include('layouts._navbar')
        @include('layouts._sidebar')

        <div class="content-wrapper">
            @yield('breadcrumb')
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
        <script>
            $(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.delete-record').click(function(e){
                    e.preventDefault()
                    if (confirm('Estas seguro en eliminar?')) {
                        let id = $(this).data('id');
                        let url = $(this).data('url');
                        $.post(url,{_method:'delete'})
                        .done(function(data){
                            if(data.status == 100){
                                $('#tr-'+id).remove();
                                toastr.success('Elemento eliminado');
                            }else{
                                toastr.error(data.message);
                            }
                        })
                        .fail(function(data){
                            toastr.error(data.message);
                        });
                    }
                });
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error('{{ $error }}');
                    @endforeach
                @endif
                @if (\Session::has('error'))
                    toastr.error('{{ session('error') }}');
                @endif
                @if (\Session::has('message'))
                    toastr.success('{{ session('message') }}');
                @endif
                 
            });
        </script>
        @stack('script')
    </body>
</html>