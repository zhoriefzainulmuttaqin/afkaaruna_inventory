<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('tittle')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="/admin" class="logo ">Afkaaruna <span>Inventory</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="@if (str_contains(url()->current(), 'peminjaman')) active @endif">
                        <a href="/peminjaman"><span class="fa fa-folder mr-3"></span>
                            Peminjaman</a>
                    </li>
                    <li class="@if (str_contains(url()->current(), 'pengajuanBarang')) active @endif">
                        <a href="/pengajuanBarang"><span class="fa fa-folder mr-3"></span>
                            Pengajuan

                            @if ($pendingCount > 0)
                                <span class="badge badge-danger">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="@if (str_contains(url()->current(), 'perbaikan')) active @endif">
                        <a href="/perbaikan"><span class="fa fa-folder mr-3"></span>
                            Perbaikan</a>
                    </li>
                    <li class="@if (str_contains(url()->current(), 'barang')) active @endif">
                        <a href="/barang"><span class="fa fa-folder mr-3"></span>
                            Barang</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="fa fa-folder mr-3"></span> Data Master</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu2">
                            <li><a href="/user"><span class="fa fa-caret-right mr-2"></span> User</a></li>
                            <li><a href="/kategori"><span class="fa fa-caret-right mr-2"></span> Kategori</a></li>
                            <li><a href="/lokasi"><span class="fa fa-caret-right mr-2"></span> Location</a></li>
                            <li><a href="/area"><span class="fa fa-caret-right  mr-2"></span> Area</a></li>
                            <li><a href="/type"><span class="fa fa-caret-right  mr-2"></span> Type</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="fa fa-home mr-3"></span> Log Out</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu3">
                            <li class="mt-5">
                                <span>Afkaaruna</span>
                                <p style="color: rgba(255, 255, 255, 0.6)">Superadmin</p>
                                <a></a>
                            </li>
                            <li>
                                <a href="/logout"><span class="fa fa-sign-out mr-2"></span> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <div class="footer">
                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <a href="https://www.jagatgenius.com/" target="_blank"
                            style="color: rgba(255, 255, 255, 0.6); text-decoration: none;"> PT. JAVA
                            GENIUS ALL TECHNOLOGY</a>
                    </p>
                </div>
            </div>
        </nav>


        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('container')
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    @yield('script')


</body>

</html>
