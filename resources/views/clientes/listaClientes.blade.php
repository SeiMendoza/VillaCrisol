@extends('plantillas.index')

@section('title', 'Clientes')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    Clientes
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Lista de Clientes</h2>
            </div><br>
            <div style="float: left; width: 450px;">
                <form action="{{ route('clientes.search') }}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" placeholder="Buscar por nombre o identidad" aria-label="Buscar por nombre o identidad"
                        aria-describedby="" maxlength="50" required
                            value="{{$text}}" />
                        <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('clientes.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                    </div>
                </form>
            </div>
            <div style="float: right">
                Agregar un nuevo cliente a la lista:
                <a class="btn btn-primary" href="{{route('clientes.create')}}">Nuevo</a>
            </div>
        </div>

        <!--------Lista de Clientes---------------->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
                        <tr>
                        <th scope="col">Nro</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Número de identidad</th>
                        <th scope="col">Número telefónico</th>
                        <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $item => $cliente)
                        <tr>
                            <td><strong>{{ ++$item }}</strong></td>
                            <td scope="col">{{$cliente->nombreCompleto}}</td>
                            <td scope="col">{{$cliente->numeroId}}</td>
                            <td scope="col">{{$cliente->numeroTelefono}}</td>
                            <td style=" text-align: center"><a class="btn btn-info" href="#">Detalles</a></td>
                            </tr>
                        @empty
                            <tr><td colspan = "7" style="text-align: center">No hay clientes registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {{ $clientes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection

