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
                    <li class="@if (str_contains(url()->current(), 'pengajuan')) active @endif">
                        <a href="/pengajuan"><span class="fa fa-folder mr-3"></span>
                            Submission</a>
                    </li>
                    <li class="@if (str_contains(url()->current(), 'list_barang')) active @endif">
                        <a href="/list_barang"><span class="fa fa-folder mr-3"></span>
                            List Item</a>
                    </li>
                    <li class="">
                        <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="fa fa-home mr-3"></span> Log Out</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu3">
                            <li class="mt-5">
                                <span>Afkaaruna</span>
                                <p style="color: rgba(255, 255, 255, 0.6)">{{ auth()->user()->name }}</p>
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
