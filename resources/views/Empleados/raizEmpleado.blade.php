@extends('plantillas.index')

@section('title', 'Empleados')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    Empleados
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Lista de Empleados</h2>
                </div><br>
            <div style="float: left; width: 450px;">
                <form action="{{ route('empleados.search') }}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre o identidad" aria-label="Buscar por nombre o identidad"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('empleado.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align: right">
                Agregar un nuevo empleado a la lista:
                <a class="btn btn-primary" href="{{route('empleado.crear')}}">Nuevo</a>
            </div>
        </div>

        <!--------Lista de empleados---------------->
        <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
    <tr>
      <th scope="col">N</th>
      <th scope="col">Nombre completo</th>
      <th scope="col">Número de identidad</th>
      <th scope="col">Número telefónico</th>
      <th scope="col">Estado</th>
      <th scope="col">Detalles</th>
    </tr>
  </thead>
  <tbody>
  @forelse($empleados as $empleado)
    <tr>
    <th scope="col">{{$empleado->id}}</th>
      <td scope="col">{{$empleado->NombreCompleto}}</td>
      <td scope="col">{{$empleado->NúmeroDeIdentidad}}</td>
      <td scope="col">{{$empleado->NúmeroTelefónico}}</td>
      <td scope="col">{{$empleado->Estado}}</td>
      <td style=" text-align: center"><a class="btn btn-info" href="{{route('empleado.mostrar' , ['id'=>$empleado->id])}}">Detalles</a></td>

    </tr>
    @empty
    <tr>
                                <td colspan = "7" style="text-align: center">No hay empleados registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {{ $empleados->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('empleado.index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection

