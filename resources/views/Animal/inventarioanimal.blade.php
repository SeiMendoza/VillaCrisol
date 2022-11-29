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
            <div style="text-align: center">  
            <button class="btn btn-primary" onclick="window.location.href='{{route('inventario.index')}}'">Restaurante</button>
                <button class="btn btn-primary" onclick="window.location.href='{{route('inventario.piscinaindex')}}'">Piscina</button>
                 <button class="btn btn-primary" onclick="window.location.href='{{route('inventario.siembraindex')}}'">Siembra</button> 
                 <button class="btn btn-primary" onclick="window.location.href='{{route('inventario.animalindex')}}'">Animales</button>
            </div>
        </div> <br>

        <!--------Lista de Clientes---------------->
        <div class="card-header">
        <div class="" style="display:block; float: left;"><h4>Inventario de Animales
        <button onclick="window.location.href='{{route('inventario.animalespdf')}}'" class="btn btn-primary" type="submit" id="b" ><i class="fas fa-save"></i> Reporte</button>  
             
        </h4>
        </div>
            <div style="display: block; float: right;">
                <form action="{{route('animal.search')}}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 200px"
                        placeholder="Buscar por nombre" aria-label="Buscar por nombre"
                        aria-describedby="basic-addon2" maxlength="50"
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('inventario.animalindex')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
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
                            <tr style="text-align:center;">
                            <th scope="col">N</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $item => $producto)
                            @if ($producto->categoria == "animales")
                                <tr style="text-align: center;">
                                        <td><strong>{{ $item+1 + ( 10 * ($productos->currentPage()-1)) }}</strong></td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->existencia}}</td>
                                        <td style="text-align:center">L.{{ number_format($producto->precio,2)}}</td>
                                        <td><a class="btn btn-info" onclick="window.location.href='{{route('animal.show', ['id'=>$producto->id])}}'">Detalles</a></td>
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
                    <a class="btn btn-primary" href="{{route('inventario.animalindex')}}">Volver</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

