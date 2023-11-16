<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="fas fa-home fa-fw"></i> 
                <span class="d-md-inline-block d-none">Home</span>
            </a>
        </li>
        {{--
            
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('modulo/pos*') ? 'active' : '' }}">
                <i class="fas fa-cash-register fa-fw"></i> 
                <span class="d-md-inline-block d-none">POS</span>
            </a>
        </li>
        --}}
         
    
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="fab fa-windows fa-fw"></i> <span class="d-md-inline-block d-none">Sistema</span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="#" class="dropdown-item"><i class="fas fa-users fa-fw"></i> Usuarios </a></li>
                <li><a href="#" class="dropdown-item"><i class="fas fa-users fa-fw"></i> Parametros </a></li>
                <li class="dropdown-divider"></li>
                <li><a href="#" class="dropdown-item"><i class="fab fa-windows fa-fw"></i> Sistema </a></li>
                {{--
                --}}
            </ul>
        </li>
    </ul>

    {{--
        
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    --}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="navbar-text d-md-inline-block d-none">{{ auth()->user()->email }}</span>
        </li>
        <li class="nav-item">&nbsp;</li>
        
         
    </ul>
</nav>
<!-- /.navbar -->
