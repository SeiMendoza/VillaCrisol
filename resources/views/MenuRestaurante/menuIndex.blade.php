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

    <div class="card shadow col-md-12" style="background: #1b6519;">
        <div class="card-header" style="background: #1b6519; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Menú de Comidas y Bebidas</h2>
            </div><br>
            <div style="display:block; float:left;">
                <form action="{{route('menu.search')}}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group" >
                        <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 410px"
                        placeholder="Buscar por nombre, tamaño o tipo de comida/bebida" aria-label="Buscar por nombre"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('menu.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="display:block; float:right; width: 350px;">
                Agregar nueva comida o bebida:
                <a class="btn btn-primary" href="{{route('menu.create')}}">Nuevo</a>
            </div>
        </div>
        <!-- Menú de comidas y bebidas -->
        <div class="card" style="color: #035700">
            <h5 style="text-align: center">Menú Activo</h5>
            <div class="" style=" height: 670px; overflow:scroll;">
                <section class="container-fluid" style="">
                    <br>
                    <div class="tb" style="display: grid; grid-template-columns: 277px 277px 277px 277px 277px; ">
                        @foreach ($menu as $m)
                        @if (($m->Activo)=="si")
                            <div class="" style="display:block; border:rounded; height: 310px; width: 260px; ">
                                <div class="card" style="border: 1px solid green; background-color: rgba(3, 197, 0, 0.278)">
                                    <!-- activo o inactivo -->
                                    <button type="button" class="btn badge bg-success position-absolute
                                    " data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$m->id}}" style="top: 0.5rem; right: 0.5rem">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$m->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desactivar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de desactivar: <strong>{{$m->Nombre}}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('menu.activar', ['id'=>$m->id])}}" method="POST">
                                                        @method('put')
                                                        @csrf
                                                        <div style="display: none">
                                                            <input type="text" id="activo" name="activo" value="no">
                                                        </div>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <input type="submit" class="btn btn-primary" value="Si">
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- image-->
                                    <img class="card-img-top" src="/imagenes/menu/{{$m->Imagen}}" width="00px" height="150px" alt="Imagen" />
                                    <div class="" style="text-align:center ;">
                                        <div class="text-center" style="padding: 0px; margin:0px;">
                                            <!-- Nombre-->
                                            <p style="padding: 0px; margin:0px;"><strong>{{$m->Nombre}}</strong></p>
                                            <!-- Tamaño-->
                                            <p style="padding: 0px; margin:0px;"><strong>{{$m->Tamaño}}</strong></p>
                                            <!-- Precio-->
                                            <p><strong> L. {{$m->Precio}}</strong></p>
                                            <div style="padding: 0px; margin:0px;" >
                                                <a href="{{route('menu.show', ['id'=>$m->id])}}" class="btn btn-info">Detalles</a>
                                            </div> <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
            </div>
        </div>
        <br>
        <!-- Menú de comidas y bebidas desactivado -->
        <div class="card text-muted" style="background-color: rgba(216, 216, 216, 0.796); color:gray">
            <h5 style="text-align: center">Menú Desactivado</h5>
        <div class="" style=" height: 370px; overflow:scroll;">
            <section class="container-fluid">
                <br>
                <div class="tb" style="display: grid; grid-template-columns: 277px 277px 277px 277px 277px; ">
                    @foreach ($menu as $c)
                    @if (($c->Activo)=="no")
                        <div class="" style="display:block;  border:rounded; height: 310px; width: 260px;  ">
                            <div class="card" style="background-color: rgba(184, 184, 184, 0.511)">
                                <!-- activo o inactivo -->
                                <button type="button" class="btn badge bg-secondary position-absolute
                                    " data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$c->id}}" style="top: 0.5rem; right: 0.5rem">
                                        <i class="fas fa-check"></i>
                                </button>
                                    <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{$c->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desactivar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de activar: <strong>{{$c->Nombre}}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('menu.activar', ['id'=>$c->id])}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div style="display: none">
                                                        <input type="text" id="activo" name="activo" value="si">
                                                    </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <input type="submit" class="btn btn-primary" value="Si">
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image-->
                                <img class="card-img-top" src="/imagenes/menu/{{$c->Imagen}}" width="00px" height="150px" alt="Imagen" />
                                <div class="" style="text-align:center ;">
                                    <div class="text-center">
                                        <!-- Nombre-->
                                        <p style="padding: 0px; margin:0px;"><strong>{{$c->Nombre}}</strong></p>
                                        <!-- Nombre-->
                                        <p style="padding: 0px; margin:0px;"><strong>{{$c->Tamaño}}</strong></p>
                                        <!-- precio-->
                                        <p><strong> L. {{$c->Precio}}</strong></p>
                                        <div>
                                            <a href="{{route('menu.show', ['id'=>$c->id])}}" class="btn btn-info">Detalles</a>
                                        </div> <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </section>
        </div>
        <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
         </div>
         </div>
    </div>
    <br>
    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('menu.index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection
