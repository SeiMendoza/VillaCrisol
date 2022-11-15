@extends('plantillas.index')

@section('title', 'Compras')

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
                <h2 style=" text-align: center;" class="m-0 font-weight-bold">Lista de compras de producto</h2>
                </div><br>
            <div style="float: left; width: 500px;">
                <form action="{{ route('regcompra.search') }}" method="get" role="search"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 310px"
                        placeholder="Buscar por numero de factura y categoria" aria-label="Buscar por numero de factra y categoria"
                        aria-describedby="basic-addon2" maxlength="50" required
                            value="<?php if(isset($text)) echo $text;?>" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                            <a href="{{route('regcompra.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align: right">
                Agregar una nueva compra a la lista:
                <a class="btn btn-primary" href="{{route('regcompra.create')}}">Nuevo</a>
            </div>
        </div>

        <!--------Lista de empleados---------------->
        <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
    <tr>
      <th scope="col">N</th>
      <th scope="col">Numero de factura</th>
      <th scope="col">Fecha</th>
      <th scope="col">Categoria</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
  @forelse($compras as $compra)
    <tr>
    <th scope="col">{{$compra->id}}</th>
      <td scope="col">{{$compra->numfactura}}</td>
    <td scope="col">
        {{\Carbon\Carbon::parse($compra->fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}
    </td>
      <td scope="col">{{$compra->categoria}}</td>

      <td style=" text-align: center"><a class="btn btn-info" href="{{route('regcompra.detail' , ['id'=>$compra->id])}}">Detalles</a></td>

    </tr>
    @empty
    <tr>
                                <td colspan = "7" style="text-align: center">No hay compras registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {!! $compras->appends(["busqueda" => $text]) !!}
            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="{{route('regcompra.index')}}">Volver</a>
        </div>
    </div>
</div>

@endsection

