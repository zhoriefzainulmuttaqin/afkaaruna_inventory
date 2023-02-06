<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
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
                <h1><a href="/admin" class="logo">Afkaaruna <span>Inventory</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="/admin"><span class="fa fa-home mr-3"></span> Home</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="fa fa-folder mr-3"></span> Data Master</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu2">
                            <li><a href="#"><span class="fa fa-caret-right mr-2"></span> Users</a></li>
                            <li><a href="/kategori"><span class="fa fa-caret-right mr-2"></span> Kategori</a></li>
                            <li><a href="#"><span class="fa fa-caret-right mr-2"></span> Location</a></li>
                            <li><a href="#"><span class="fa fa-caret-right  mr-2"></span> Area</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/peminjaman"><span class="fa fa-folder mr-3"></span> Peminjaman</a>
                    </li>
                    <li>
                        <a href="/perbaikan"><span class="fa fa-folder mr-3"></span> Perbaikan</a>
                    </li>
                    <li>
                        <a href="/barang"><span class="fa fa-folder mr-3"></span> Barang</a>
                    </li>
                    <li class="active">
                        <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="fa fa-folder mr-3"></span> Lainnya</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu3">
                            <li class="mt-5">
                                <span>Zhorief Zainul Muttaqin</span>
                                <p style="color: rgba(255, 255, 255, 0.6)">Superadmin</p>
                                <a></a>
                            </li>
                            <li>
                                <a href="/login"><span class="fa fa-sign-out mr-2"></span> Logout</a>
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

    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>
