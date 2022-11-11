<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>VillaCrisol</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href={{ asset("css/styles.css") }} rel="stylesheet" type="text/css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Villa Crisol</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"
             href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Login</a></li>
                        <li><a class="dropdown-item" href="#!"></a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!"></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">INICIO</div>
                            <a class="nav-link" href="{{route('index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-house"></i></div>
                                PRINCIPAL
                            </a>
                            <div class="sb-sidenav-menu-heading">Centro Turístico</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fas fa-drumstick-bite'></i></div>
                                Restaurante
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon">
                                        <i class="fa fa-list-alt"></i></div>
                                        Inventario</a>
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon">
                                        <i class="fa fa-shopping-bag"></i></div>
                                        Compras</a>
                                    <a class="nav-link" href="{{route('menu.index')}}"><div class="sb-nav-link-icon">
                                            <i class="fa fa-list"></i></div>
                                        Menú</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reservaciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="layout-static.html"><div class="sb-nav-link-icon"><i class='fa fa-list-ol'></i></div>
                                        Reservaciones</a>
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>Calendario</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Área de Mantenimiento</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fa fa-list-alt"></i></div>
                                Inventario
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fa fa-shopping-bag"></i></div>
                                Compras
                            </a>
                            <div class="sb-sidenav-menu-heading">Propiedad Privada</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tractor"></i></div>
                                Siembras
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePage" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-crow"></i></div>
                                Animales
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePage" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon"><i class="fa fa-list-alt"></i></div>
                                        Inventario</a>
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon"><i class="fa fa-shopping-bag"></i></div>
                                        Compras</a>
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon"><i class='fas fa-cash-register'></i></div>
                                        Ventas</a>
                                    <a class="nav-link" href="#"><div class="sb-nav-link-icon"><i class='fa fa-shopping-basket'></i></div>
                                        Producción</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Personas</div>
                            <a class="nav-link" href="{{route('clientes.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="{{route('empleado.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-card-alt"></i></div>
                                Empleados
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                                Usuarios
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="background-color: rgb(216, 216, 216);">
                <main>
                    @if(session('mensaje'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{session('mensaje')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <h1 class="mt-4 text-center" >Página de inicio</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <div class="row">
                            <div class="container-fluid px-4">
                                <div class="card shadow col-md-12 items-center">
                                    <div class="card-header" style="background-image : url('imagenes/restaurante.jpg');background-position: center;">
                                    <h3 class="text-center font-weight-light my-4" style="background-color: rgba(255, 255, 255, 0.679);" >Restaurante</h3></div>
                                    <div class="card-body" style="background-color: rgba(31, 118, 23, 0.51)">
                                        <div class="row mb-3">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(18, 212, 0, 0.51)">
                                                    <div class="card-body">INVENTARIO</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link"
                                                        href="{{route('inventario.index')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(58, 215, 131, 0.51)">
                                                    <div class="card-body">COMPRAS</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="{{route('regcompra.index')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(56, 155, 122, 0.712)">
                                                    <div class="card-body">MENU</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="{{route('menu.index')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="container-fluid px-4">
                                <div class="card shadow col-md-12 items-center">
                                    <div class="card-header" style="background-image : url('imagenes/personas.png'); background-position: bottom;">
                                        <h3  class="text-center font-weight-light my-4"
                                        style="background-color: rgba(255, 255, 255, 0.862);" >Personas</h3></div>
                                    <div class="card-body" style="background-color: #25416b;">
                                        <div class="row mb-3">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4 bot" style="background-color: rgba(0, 0, 169, 0.712)">
                                                    <div class="card-body"> EMPLEADOS</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link"
                                                        href="{{route('empleado.index')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(48, 74, 191, 0.712)">
                                                    <div class="card-body">CLIENTES</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="{{route('clientes.index')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(21, 31, 168, 0.712)">
                                                    <div class="card-body">USUARIOS</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="#">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="container-fluid px-4">
                                <div class="card shadow col-md-12 items-center">
                                    <div class="card-header" style="background-image : url('/imagenes/registro.png'); background-position: bottom;">
                                        <h3  class="text-center font-weight-light my-4"
                                        style="background-color: rgba(255, 255, 255, 0.862);" >Registros</h3></div>
                                    <div class="card-body" style="background-color: #310072c5;">
                                        <div class="row mb-3">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4 bot" style="background-color: rgba(136, 0, 255, 0.715)">
                                                    <div class="card-body">REGISTRO DE PRODUCTOS</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link"
                                                        href="{{route('producto.create')}}">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card text-white mb-4" style="background-color: rgba(145, 84, 203, 0.619)">
                                                    <div class="card-body">COMPRAS</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="#">MOSTRAR</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; CENTRO TURISTICO VILLACRISOL 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src={{ asset("js/scripts.js") }}></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
