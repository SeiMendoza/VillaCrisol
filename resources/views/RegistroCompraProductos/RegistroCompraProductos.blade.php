@extends('plantillas.register1')
@section('title', 'Registro de compras')
@section('content')
@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
    <div class="card shadow mb-4">
        <div class="card-header py-2" style="background: #0d6efd">
            <div style="float: left">
                <h2 class="m-0 font-bold" style="color: white">Ristrar compras</h2>
            </div>

        </div>

        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row" id="tblaBody">
                <div class="col-lg-5 d-lg-block">
                    <div class="p-3">
                    <form method="post" action="{{route('regcompra.create')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numfactura">Número de factura</label>
                                <input class="form-control @error('numfactura') is-invalid @enderror" id="numfactura"
                                name="numfactura" type="num" maxlength="5" placeholder="" value="{{ old('numfactura') }}" />
                                @error('numfactura')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="fecha">Fecha de registro de compra</label>
                                <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                                name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
                                value="{{old('fecha')}}" />
                                @error('fecha')
                                    <small class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="proveedor">Nombre del proveedor</label>
                                <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                                name="proveedor" type="text" maxlength="45"
                                placeholder="" value="{{ old('proveedor') }}" />
                                @error('proveedor')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="total">Ingrese el total de la compra</label>
                                <input class="form-control @error('total') is-invalid @enderror" id="total"
                                name="total" type="num" value="{{old('total')}}" maxlength="6"/>
                                @error('total')
                                    <small class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="total">Ingrese el impuesto de la compra</label>
                                <input class="form-control @error('impuesto') is-invalid @enderror" id="impuesto"
                                name="impuesto" type="num" value="{{old('impuesto')}}" maxlength="5"/>
                                @error('impuesto')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="categoria">Seleccione una categoria </label>
                                <select  class="form-control @error('categoria') is-invalid @enderror" name="categoria">
                                    <option value="">--seleccione una categoria--</option>
                                    <option value="restaurante" @if(old('categoria') == "restaurante") {{ 'selected' }} @endif>Restaurante</option>
                                    <option value="piscina" @if(old('categoria') == "piscina") {{ 'selected' }} @endif>Piscina</option>
                                    <option value="siembra" @if(old('categoria') == "siembra") {{ 'selected' }} @endif>Siembra</option>
                                    <option value="animales" @if(old('categoria') == "animales") {{ 'selected' }} @endif>Animales</option>
                                </select>
                                @error('categoria')
                                    <small class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="descripción">Descripción de la compra</label>
                                <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción"
                                name="descripción" type="text" style="height:145px" maxlength="150">{{ old('descripción') }}</textarea>
                                @error('descripción')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 15px">
                            <div class="col-sm-5">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop_detalle">
                                    Agregar Productos
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary mt-10" type="submit">Guardar</button>
                            </div>
                            <div class="col-sm-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cancelar
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cancelar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de cancelar el formulario?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="{{route('index')}}" class="btn btn-primary">Si</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="table-responsive" id="tblaBody">
                        <table class="table table" id="dataTable">
                            <thead class="card-header py-3" style="background: #1a202c; color: white">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th style="text-align:center;" colspan="3">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            @forelse($detalles as $detalle)
    <tr>
      <td scope="col">{{$detalle->producto->nombre}}</td>
      <td scope="col">{{$detalle->cantidad}}</td>
      <td scope="col">{{$detalle->precio}}</td>
      <td style="text-align: center"><a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_cliente">
        <i class="fa fa-edit" style="color: white"></i></a>
            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal_elimira_producto">
             <i class="fa fa-fw fa-trash" style="color: white"></i></a></td>
       </td>
     <!-- Modal -->
     <div class="modal fade" id="modal_elimira_producto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de eliminar el producto?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <form style="text-align:center;" method="post" action="{{route('regcompra.borrar', ['id'=>$detalle->id])}}">
                                                 @csrf
                                                @method('delete')
                                                <input type="submit" value="si" class="btn btn-danger">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </tr>
    @empty
    <tr>
                                <td colspan = "7" style="text-align: center">No hay compras</td>
                            </tr>

                        @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop_detalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Agregar productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('regcompra.detalle')}}" method="post">
                        @csrf
                        <div class="col-sm-8">
                            <input type="text" name="compra_id" id="compra_id" value="" hidden>
                            <label for="producto">Seleccione el producto</label>
                            <select  class="form-control @error('producto') is-invalid @enderror" name="producto">
                                <option value="">--seleccione un producto--</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" @if(old('producto') == "{{ $producto->id }}") {{ 'selected' }} @endif>
                                        {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            @error('producto')
                                <small class="invalid-feedback" >
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-8">
                            <label for="cantidad">Ingrese la cantidad de productos</label>
                            <input class="form-control @error('cantidad') is-invalid @enderror" id="cantidad"
                            name="cantidad" type="number" value="{{old('cantidad')}}" maxlength="3" required/>
                            @error('cantidad')
                                <small class="invalid-feedback" >
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-8">
                            <label for="precio">Ingrese el precio del producto</label>
                            <input class="form-control @error('precio') is-invalid @enderror" id="precio"
                            name="precio" type="number" value="{{old('precio')}}" maxlength="6" required/>
                            @error('precio')
                                <small class="invalid-feedback" >
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-8">
                            <label for="imp">Ingrese el impuesto del producto</label>
                            <input class="form-control @error('imp') is-invalid @enderror" id="imp"
                            name="imp" type="number" value="{{old('imp')}}" maxlength="6"/>
                            @error('imp')
                                <small class="invalid-feedback" >
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <br>
                        <div style="text-align: center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
