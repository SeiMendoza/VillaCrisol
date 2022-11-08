@extends('plantillas.index')

@section('title', 'Productos')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #1b6519; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Inventario de Productos</h2>
            </div><br>
            <div style="text-align: center"> <button class="btn btn-primary">Restaurante</button>
                <button class="btn btn-primary">Piscina</button>
                 <button class="btn btn-primary">Siembra</button> <button class="btn btn-primary">Animales</button>
            </div>
        </div> <br>

        <!--------Lista de Clientes---------------->
        <div class="card-header">
            <div class="" style="display:block; float: left;"><h4>Inventario del Restaurante</h4></div>
            <div style="display: block; float: right;">
                <form action="{{route('restaurante.search')}}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 200px"
                        placeholder="Buscar por nombre" aria-label="Buscar por nombre o identidad"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('inventario.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                        <div class="input-group-append" style="margin-left: 3px">
                            <button class="btn btn-success ">Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" style=" text-align: center">
                        <thead class="card-header" style="background: rgb(52, 111, 37); color:white;">
                            <tr>
                            <th scope="col">N</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($productos as $item => $producto)
                            @if ($producto->categoria == "restaurante")
                                <tr>
                                <td><strong>{{ ++$item }}</strong></td>
                                <td scope="col">{{$producto->nombre}}</td>
                                <td scope="col">1</td>
                                <td scope="col" style="text-align: right">L 1000.00</td>
                                <td><a class="btn btn-info" href="{{route('restaurante.show', ['id'=>$producto->id])}}">Detalles</a></td>
                                </tr>
                            @endif
                            @empty
                                <tr><td colspan = "7" style="text-align: center">No hay productos registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                    {{ $productos->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <div class="card shadow col-md-12">
                <div class="card-body row justify-content-center">
                    <a class="btn btn-primary" href="{{route('inventario.index')}}">Volver</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

