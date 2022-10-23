@extends('plantillas.index')

@section('title', 'Menú')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    Menú
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #1b6519; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Menú de Comidas y Bebidas</h2>
            </div><br>
            <div style="float: left; width: 450px;">
                <form action="" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre" aria-label="Buscar por nombre"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="#" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="float: right">
                Agregar nueva comida o bebida:
                <a class="btn btn-primary" href="{{route('menu.create')}}">Nuevo</a>
            </div>
        </div>

        <!-- Menú de comidas y bebidas -->
        <div class="" style=" height: 400px; overflow:scroll;  float:left; ">
            <section class="container-fluid">
                <br>
                <div class="tb" style="display: grid; grid-template-columns: 155px 155px 155px 155px;">

                        <div class="" style="display:block;  border:rounded; height: 155px; width: 155px; ">
                            <div class="card" style="border: 1px solid green">
                                <!-- activo o inactivo -->
                                <div class="" >
                                    <div class="form-floating mb-3 mb-md-0">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn badge bg-success position-absolute
                                        " data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="top: 0.5rem; right: 0.5rem">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Desactivar</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro de desactivar la comida/bebida?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                        <a href="" onclick="" class="btn btn-primary">Si</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image-->
                                <img class="card-img-top" src="imagenes/crisol.png" width="00px" height="120px" alt="Imagen" />
                                <div class="" style="text-align:center ;">
                                    <div class="text-center">
                                        <!-- Nombre-->
                                        <strong>Comida</strong>
                                        <!-- precio-->
                                        <p class="text-muted"><strong> L. 120</strong></p>
                                        <div>
                                            <a href="{{route('menu.show')}}" class="btn btn-info">Detalles</a>
                                        </div> <br/>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </section>
        </div>
        <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
            Paginacion
         </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection
