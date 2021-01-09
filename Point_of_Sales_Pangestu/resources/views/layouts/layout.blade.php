<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Point of Sales</title>
        <link href="{{url('admin/dist/css/styles.css')}}" rel="stylesheet" />

        {{-- link bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        {{-- Link data table --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

        {{-- Link Font Awesome --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        {{-- google api --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
            .coba{
                background: #FEAC5E;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #4BC0C8, #C779D0, #FEAC5E);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #4BC0C8, #C779D0, #FEAC5E); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            }
        </style>
    </head>
    <body class="sb-nav-fixed" {{Session::get('berhasil') ? 'onload = JavaScript:AutoRefresh(1000);' : '' }} >

        <!-- navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <img src="{{url('landing/assets/images/logo.png')}}" alt="website logo" class="ml-2" width="20px" height="20px">
            <a class="navbar-brand" href="{{route('home')}}">Point <span style="font-weight: lighter">of</span> Sales</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">

                @if ($level == "ADMIN" )
                    <li class="nav-item">
                        <img src="{{url('landing/assets/images/admin.png')}}" width="40px" height="40px" style="object-fit: cover" class="image rounded-circle">
                    </li>
                @elseif($level == "KASIR")
                    <li class="nav-item">
                        <img src="{{url('landing/assets/images/kasir.png')}}" width="40px" height="40px" style="object-fit: cover" class="image rounded-circle">
                     </li>
                @elseif($level == "MANAGER")
                    <li class="nav-item">
                        <img src="{{url('landing/assets/images/manager.png')}}" width="40px" height="40px" style="object-fit: cover" class="image rounded-circle">
                    </li>
                @endif

                <li class="nav-item">
                <form action="{{route('logout')}}" method="POST" method="POST" onclick="return confirm('Yakin ?');">
                    @csrf
                        <button class="btn" style="color:white;" type="submit"><i class="fas fa-sign-out-alt" style="color: white"></i></button>
                    </form>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{route('home')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Menu</div>

                            @if ($level == "ADMIN")
                            <a class="nav-link" href="{{route('barang.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Barang
                            </a>
                            <a class="nav-link" href="{{route('merek.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Merek
                            </a>
                            <a class="nav-link" href="{{route('distributor.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Distributor
                            </a>
                            @elseif($level == "MANAGER")
                            <a class="nav-link" href="{{route('laporan.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Laporan
                            </a>
                            @elseif($level == "KASIR")
                                <a class="nav-link" href="{{route('transaksi.index')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Transaksi
                                </a>
                            @endif
                            

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Projek ini Dibuat:</div>
                        &copy; M Rizky Pangestu
                    </div>
                </nav>

            </div>
            @yield('content')
        </div>  
        </div>

        {{-- link jquery --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        {{-- link js --}}
        <script src="{{url('admin/dist/js/scripts.js')}}"></script>
      
        {{-- link data table --}}
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
        
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            $.(document).ready( function () {
                $('#table_id').DataTable();
            } );
        </script>

        <script type = "text/JavaScript">
            <!--
            function AutoRefresh( t ) {
                setTimeout("location.reload(true);", t);
            }
            //-->
        </script>

        @include('sweetalert::alert')

    </body>

   
</html>
