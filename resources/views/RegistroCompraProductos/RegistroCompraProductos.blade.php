@extends('plantillas.register')
@section('title', 'Registro de compra de productos')

@section('encabezado', 'Registro de compras de productos')
@section('content')
<form method="post" action="{{route('regcompra.create')}}">
    @csrf
    <div class="modal-body">
    <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control @error('numfactura') is-invalid @enderror" id="numfactura"
                     name="numfactura" type="num" maxlength="5"
                    placeholder="" value="{{ old('numfactura') }}" />
                    <label for="numfactura">Número de factura</label>
                    @error('numfactura')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                     name="proveedor" type="text" maxlength="45"
                    placeholder="" value="{{ old('proveedor') }}" />
                    <label for="proveedor">Nombre del proveedor</label>
                    @error('proveedor')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción"
                     name="descripción" type="text" maxlength="150">{{ old('descripción') }}"</textarea>
                    <label for="descripción">Descripción de la compra</label>
                    @error('descripción')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                <select  class="form-control @error('categoria') is-invalid @enderror" name="categoria">
                <option value="">--seleccione una categoria--</option>
                <option value="restaurante" @if(old('categoria') == "restaurante") {{ 'selected' }} @endif>Restaurante</option>
                <option value="piscina" @if(old('categoria') == "piscina") {{ 'selected' }} @endif>Piscina</option>
                <option value="siembra" @if(old('categoria') == "siembra") {{ 'selected' }} @endif>Siembra</option>
                <option value="animales" @if(old('categoria') == "animales") {{ 'selected' }} @endif>Animales</option>
</select>
<label for="categoria">Seleccione una categoria </label>
                    @error('categoria')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>
            <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating">
                <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
      name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
       value="{{old('fecha')}}" />
      <label for="fecha">Fecha de registro de compra</label>
                    @error('fecha')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('impuesto') is-invalid @enderror" id="impuesto" name="impuesto"
                    type="num" value="{{old('impuesto')}}"/>
                    <label for="impuesto">Ingrese el impuesto</label>
                    @error('impuesto')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating">
                <input class="form-control @error('total') is-invalid @enderror" id="total"
      name="total" type="num" value="{{old('total')}}" maxlength="6"/>
      <label for="total">Ingrese el total de la compra</label>
                    @error('total')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
<-------lista de productos-------->
<div class="card-body">
            <div class="table-responsive">
            <table class="table" id="table">
                    <thead class="card-header" style="background: rgb(49, 63, 95); color:white;">
    <tr>
      <th scope="col">N</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody>
  @forelse($rcompraproductos as $rcompraproducto)
    <tr>
    <th scope="col">{{$rcompraproducto->id}}</th>
      <td scope="col">{{$rcompraproducto->nombre}}</td>
      <td scope="col">{{$rcompraproducto->cantidad}}</td>
      <td scope="col">{{$rcompraproducto->precio}}</td>
      <td style=" text-align: center"><a class="btn btn-info" href="">Editar</a></td>
      <td>
            <form method="post" action="{{route('regcompra.borrar', ['id'=>$rcompraproducto->id])}}"> 
            @csrf
            @method('delete')
            <input type="submit" value="eliminar" class="btn btn-danger">
            </form>
        </td>
    </tr>
    @empty
    <tr>
     <td colspan = "7" style="text-align: center">No hay compras</td>
</tr> 
  @endforelse
    </tbody>
   </table>
            </div>
            <div class="col-md-5" style="text-align: center; margin: 0 auto; margin-bottom: 10px; margin-top: 12px;">
                {{ $rcompraproductos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="card shadow col-md-12">
        <div class="card-body row justify-content-center">
            <a class="btn btn-primary" href="">Volver</a>
        </div>
    </div>
</div>

<br>
    <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <button class="btn btn-primary mt-10" type="submit">Guardar</button>
                </div>
            </div>
    <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
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
                            <a href="" class="btn btn-primary">Si</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </form>

 @endsection
