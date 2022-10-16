@extends('plantillas.index')

@section('title', 'Compras')

@section('content')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Se ha guardado la nueva compra correctamente</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="container-fluid px-4">
    Restaurante
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Lista de Compras</h2>
            </div>
            <div style="float: left; width: 400px;">
                <form action="{{ route('compras.search') }}" method="GET"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input class="form-control" type="text" name="busqueda" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" type="submit" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            </div>
            <div style="text-align: right">
                Agregar una nueva compra a la lista:
                <a class="btn btn-primary" href="{{route('compras.create')}}">Nuevo</a>
            </div>
        </div>

        <!--------Lista de Compras---------------->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre de la Compra</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th style=" text-align: center"  scope="col">Detalles de la compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($compras as $item=> $compra)
                            <tr>
                                <td><strong>{{ ++$item }}</strong></td>
                                <td>{{ $compra->nombreCompra }}</td>
                                <td>{{ $compra->fecha }}</td>
                                <td>{{ $compra->total }}</td>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <td style=" text-align: center"><a class="btn btn-success" href="{{route('compras.show', ['id'=>$compra->id])}}">Detalles</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan = "7" style="text-align: center">No hay compras registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {{ $compras->links('pagination::bootstrap-4') }}
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
