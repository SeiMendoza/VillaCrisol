@extends('plantillas.index')

@section('title', 'Compras')

@section('content')

<div class="container-fluid px-4">
    Restaurante
    <div class="card shadow col-md-12">
        <div class="card-header" style="background: #25416b; color: white">
            <div>
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Detalles de: {{ $compra->nombreCompra}}</h2>
            </div>
            <div style="text-align: right">
                Editar esta compra:
                <a class="btn btn-warning" href="#">Editar</a>
            </div>
        </div>

        <!--------Lista de Compras---------------->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="card-header" style="background: rgb(38, 45, 61); color:white;">
                        <tr>
                            <th scope="col">Campo</th>
                            <th scope="col">Valor</th>
                          </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row">Número de factura:</th>
                            <td>{{$compra->numeroFactura}}</td>
                        </tr>

                        <tr>
                            <th cope="row">Nombre de la Compra</th>
                            <td>{{ $compra->nombreCompra}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Fecha de Compra</th>
                            <td>{{$compra->fecha}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Cantidad</th>
                            <td>{{$compra->cantidad}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Precio</th>
                            <td>{{$compra->precio}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Total</th>
                            <td>{{$compra->precio}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Observación</th>
                            <td>{{$compra->observacion}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Imagen de la factura</th>
                            <td>{{$compra->imagenFactura}}</td>
                        </tr>
                        <tr><th></th></tr>
                    </tbody>
                    <tfoot>
                        <tr class="form-floating mb-3 mb-md-0">
                            <td>fecha de registro: {{$compra->fechaRegistro}}</td>
                            <td>Registrado por: {{$compra->usuario}}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body" style="text-align: center">
            <a class="btn btn-primary" href="{{route('compras.index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection

