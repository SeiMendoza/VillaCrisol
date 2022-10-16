<!DOCTYPE html>
@extends('plantillas.index')

@section('title', 'Empleados')

@section('content')
<br>
@if (session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif

<div class="container-fluid px-4">
    Empleados
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Lista de Empleados</h2>
            </div>
            <div style="float: left; width: 400px;">
                <form action="{{ route('empleados.search') }}" method="GET"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input class="form-control" type="text" name="busqueda" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" type="submit" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            </div>
            <div style="text-align: right">
                Agregar un nuevo empleado a la lista:
                <a class="btn btn-primary" href="{{route('empleado.crear')}}">Nuevo</a>
            </div>
        </div>

        <!--------Lista de Compras---------------->
        <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre completo</th>
      <th scope="col">Número de identidad</th>
      <th scope="col">Correo electrónico</th>
      <th scope="col">Número telefónico</th>
      <th scope="col">Fecha de ingreso</th>
      <th scope="col">Estado</th>
      <th scope="col">Detalles</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
  @forelse($empleados as $empleado)
    <tr>
    <th scope="col">{{$empleado->id}}</th>
      <td scope="col">{{$empleado->NombreCompleto</td>
      <td scope="col">{{$empleado->NúmeroDeIdentidad}}</td>
      <td scope="col">{{$empleado->CorreoElectrónico}}</td>
      <td scope="col">{{$empleado->NúmeroTelefónico}}</td>
      <td scope="col">{{$empleado->FechaDeIngreso}}</td>
      <td scope="col">{{$empleado->Estado}}</td>
      <td style=" text-align: center"><a class="btn btn-info" href="{{route('empleado.mostrar' , ['id'=>$empleado->id])}}">Detalles</a></td>
      
     <td>
     <form method= "post" action="{{route('empleado.borrar' , ['id'=>$empleado->id])}}">
      @csrf
      @method('delete')
      <input style=" text-align: center" type="submit" value="Eliminar" class="btn btn-danger" > 
     </form>
      </td> 
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

