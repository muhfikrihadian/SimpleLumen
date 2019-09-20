<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Request::segment(1) != null ? ucfirst(Request::segment(1)).' - ' : 'Dashboard - ' }}{{ config('app.name', 'PAS') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/park16.png') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @yield('head-content')
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <span class="mr-2 d-none d-lg-inline text-white-600 small">{{ App\User::name() }}</span>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) == null ? 'active' : null }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'report' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('report') }}">
                    <i class="fas fa-fw fa-stream"></i>
                    <span>Report</span>
                </a>
            </li>
            @can('merchant-list')
            <li class="nav-item {{ Request::segment(1) == 'merchant' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('merchant') }}">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Merchant</span>
                </a>
            </li>
            @endcan
            @can('terminal-list')
            <li class="nav-item {{ Request::segment(1) == 'terminal' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('terminal') }}">
                    <i class="fas fa-fw fa-terminal"></i>
                    <span>Terminal</span>
                </a>
            </li>
            @endcan
            @can('location-list')
            <li class="nav-item {{ Request::segment(1) == 'location' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('location') }}">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>Location</span>
                </a>
            </li>
            @endcan
            @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list') || app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list'))
                <li class="nav-item {{ Request::segment(1) == 'roles' || Request::segment(1) == 'users' ? 'active' : null }}">
                    <a class="nav-link collapsed" href="#users" data-toggle="collapse" data-target="#collapsePagesUsers" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Users Setting</span>
                    </a>
                    <div id="collapsePagesUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @can('user-list')
                            <a class="collapse-item {{ Request::segment(1) == 'users' ? 'active' : null }}" href="{{ route('users.index') }}">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Users</span>
                            </a>
                            @endcan
                            @can('role-list')
                            <a class="collapse-item {{ Request::segment(1) == 'roles' ? 'active' : null }}" href="{{ route('roles.index') }}">
                                <i class="fas fa-fw fa-user-tag"></i>
                                <span>Roles</span>
                            </a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" href="#settings" data-toggle="collapse" data-target="#collapsePagesSettings" aria-expanded="true" aria-controls="collapsePages">
                  <i class="fas fa-cog"></i>
                  <span>Settings</span>
              </a>
              <div id="collapsePagesSettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                    </a>
                    <a class="collapse-item nav-item {{ Request::segment(1) == 'config' ? 'active' : null }}" href="{{ route('config') }}">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Config</span>
                    </a>
                    <a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </li>
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid py-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        {!! App\User::breadcumb() !!}
                    </h1>
                </div>
                @yield('content')
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website {{ date('Y') != '2019' ? '2019 - '.date('Y') : date('Y') }}</span>
                </div>
            </div>
        </footer>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@yield('foot-content')
</body>
</html>
