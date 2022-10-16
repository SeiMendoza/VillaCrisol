@extends('plantillas.register')
@section('title', 'Registro de Compras')

@section('encabezado', 'Registro de Compras')
@section('content')
<form method="post" action="{{route('compras.store')}}">
    @csrf
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control @error('numeroFactura') is-invalid @enderror" id="numeroFactura"
                     name="numeroFactura" type="number"required autocomplete="numeroFactura"
                    placeholder="#####" value="{{ old('numeroFactura') }}" />
                    <label for="numeroFactura">Número de Factura</label>
                    @error('numeroFactura')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('nombreCompra') is-invalid @enderror" id="nombreCompra" name="nombreCompra" type="text"
                     placeholder="compra de verduras"
                    value="{{ old('nombreCompra') }}" />
                    <label for="nombreCompra">Nombre de la Factura</label>
                    @error('nombreCompra')
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
                    <input class="form-control @error('fecha') is-invalid @enderror" id="fecha" max="{{date('Y-m-d')}}"
                    name="fecha" type="date" placeholder="12/05/1999" value="{{ old('fecha') }}" />
                    <label for="fecha">Fecha de la compra</label>
                    @error('fecha')
                        <small class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" type="number" placeholder="123.25"
                    value="{{ old('cantidad') }}" />
                    <label for="cantidad">Cantidad</label>
                    @error('cantidad')
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
                    <input class="form-control @error('precio') is-invalid @enderror" id="precio" type="number" name="precio" placeholder="123.25"
                    value="{{ old('precio') }}" />
                    <label for="precio">Precio</label>
                    @error('precio')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" type="number" placeholder="45.00"
                    value="{{ old('total') }}" />
                    <label for="total">Total de la compra</label>
                    @error('total')
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
                    <textarea class="form-control @error('observacion') is-invalid @enderror" name="observacion" id="observacion" cols="30" rows="10"
                    value="" >{{ old('observacion') }}</textarea>
                    <label for="observacion">Observación</label>
                    @error('observacion')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form mb-3 mb-md-0">
                    <label for="imagenFactura">Agregue una Imagen</label><br>
                    <input type="file" name="imagenFactura" id="imagenFactura" class="form-control @error('imagenFactura') is-invalid @enderror" value="{{ old('imagenFactura') }}">
                    @error('imagenFactura')
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
                            <a href="{{route('compras.index')}}" class="btn btn-primary">Si</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
<div class="small"><a href="#">Have an account? Go to login</a></div>
<div class="my-2 float-start">
    <span class="text-600 text-90" >Fecha:
        <span id="date_r">
            <script>
                date = new Date();
                year = date.getFullYear();
                month = date.getMonth() + 1;
                day = date.getDate();

                document.getElementById("date_r").innerHTML = day + "/" + month + "/" + year;
            </script>
        </span>
    </span>
</div>
<div class="my-2 float-end">
    <span id="usuario" class="text-600 text-90">Registrado por: Admin</span>
</div>
@endsection
