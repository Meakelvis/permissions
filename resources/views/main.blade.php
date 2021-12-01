<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>Special Clearance</title>

        <!-- Custom fonts for this template-->
        <link
            rel="stylesheet"
            href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"
        />

        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}" />
        @yield('style')
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul
                class="
                    navbar-nav
                    bg-gradient-primary
                    sidebar sidebar-dark
                    accordion
                "
                id="accordionSidebar"
            >
                <!-- Sidebar - Brand -->
        
                <a
                    class="
                        sidebar-brand
                        d-flex
                        align-items-center
                        justify-content-center
                    "
                >
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Travel Permits</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0" />

                <!-- Nav Item - Dashboard -->
                @canany(['view-users', 'can-revert', 'can-approve'])
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('applications') }}">
                            <i class="fas fa-magic"></i>
                            <span>Special Cases</span></a
                        >
                    </li>
                @endcanany

                @can('create-user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span></a
                    >
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('org.dashboard') }}">
                        <i class="fas fa-building"></i>
                        <span>Organisation</span></a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <a class="nav-link" href=""
                        data-toggle="modal"
                        data-target="#logoutModal"
                    >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                        <span>Logout</span></a
                    >
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block" />

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button
                        class="rounded-circle border-0"
                        id="sidebarToggle"
                    ></button>
                </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav
                        class="
                            navbar navbar-expand navbar-light
                            bg-white
                            topbar
                            mb-4
                            static-top
                            shadow
                        "
                    >
                        <!-- Sidebar Toggle (Topbar) -->
                        <button
                            id="sidebarToggleTop"
                            class="btn btn-link d-md-none rounded-circle mr-3"
                        >
                            <i class="fa fa-bars"></i>
                        </button>

                        @canany(['view-users', 'can-revert', 'can-approve', 'add-organisation'])
                            <!-- Topbar Search -->
                            <form action="{{ route('search') }}" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for No Plate"
                                        aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endcanany

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a
                                    class="nav-link dropdown-toggle"
                                    id="userDropdown"
                                    role="button"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span
                                        class="
                                            mr-2
                                            d-none d-lg-inline
                                            text-gray-600
                                            small
                                        "
                                    ></span> 
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    @include('includes.messages')

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span
                                >Copyright &copy; mowt {{ now()->year
                                }}</span
                            >
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ready to Leave?
                        </h5>
                        <button
                            class="close"
                            type="button"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your
                        current session.
                    </div>
                    <form
                        class="modal-footer"
                        action="{{ route('logout') }}"
                        method="POST"
                    >
                        @csrf
                        <a
                            class="btn btn-secondary"
                            href=""
                            data-dismiss="modal"
                        >
                            Cancel
                        </a>
                        <button class="btn btn-primary" type="submit">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> -->

        {{--
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
        --}}

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <!-- <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
        <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

        @yield('script')
    </body>
</html>
