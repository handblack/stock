<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">        
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/AdminLTELogo_color.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Tejidos Jorgito SAC</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{--
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        --}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            {{--
            
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-legacy" data-widget="treeview" role="menu">
            
            --}}
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu">

                <!-- dashboard -->
                
                <li class="nav-item {{ request()->is('dashboard*') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{--
                <!-- SISTEMA -->
                <li class="nav-item {{ request()->is('system*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ request()->is('system*') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-windows"></i>
                        <p>
                            Sistema
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('system/user*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- MAESTRO -->
                <li class="nav-item {{ request()->is('master*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-double"></i>
                        <p>
                            Maestro
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{ request()->is('master/product*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('line.index') }}" class="nav-link {{ request()->is('master/line*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Linea</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subline.index') }}" class="nav-link {{ request()->is('master/subline*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Linea</p>
                            </a>
                        </li>
                    </ul>
                </li>
                --}}
                <li class="nav-item {{ request()->is('inventario*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('inventario*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Inventario
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('movimiento') }}" class="nav-link {{ request()->is('inventario/movimiento*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movimientos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock') }}" class="nav-link {{ request()->is('inventario/stock*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('balanza.index') }}" class="nav-link {{ request()->is('inventario/balanza*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Balanza</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('inventario*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('inventario*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Log
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('movimiento') }}" class="nav-link {{ request()->is('inventario/movimiento*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movimientos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header"> </li>
                <li class="nav-item">
                    <a href="#" onclick="document.getElementById('FormLogoutSystem').submit(); return false;" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>
                            Salir                            
                        </p>
                    </a>
                </li>
                <form action="{{ route('logout') }}" id="FormLogoutSystem" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>