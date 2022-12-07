@extends('plantillas.index')

@section('title', 'Animales')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Inventario Animales</h2>
            </div><br>
            <div style="float: left; width: 450px;">
                <form action="{{ route('compraAnimal.searchinventario') }}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 250px"
                         placeholder="Buscar por tipo o proposito" aria-label="Buscar por tipo o proposito"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('compraAnimal.inventario')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--------Lista de Animales---------------->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
                        <tr>
                        <th scope="col">N</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Proposito</th>
                        <th scope="col">Precio</th>
                        <th scope="col">cantidad</th>
                        <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($animales as $item => $animal)
                        <tr>
                            <td><strong>{{ ++$item }}</strong></td>
                            <td scope="col">{{$animal->datos->tipo}}</td>
                            <td scope="col">{{$animal->datos->proposito}}</td>
                            <td scope="col">L.{{ number_format($animal->precioVenta,2)}}</td>
                            <td scope="col">{{$animal->cantidad}}</td>
                            <td style=" text-align: center">
                                <a class="btn btn-info" href="{{route('compraAnimal.show' , ['id'=>$animal->id])}}">Detalles</a>
                            </td>
                            </tr>
                        @empty
                            <tr><td colspan = "7" style="text-align: center">No hay animales registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {{ $animales->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('compraAnimal.inventario')}}">Volver</a>
        </div>
    </div>
</div>

@endsection

