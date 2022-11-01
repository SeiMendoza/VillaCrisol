@extends('plantillas.register')
@section('title', 'Registrar Productos')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@section('encabezado', 'Registro de productos')
@section('content')

    <form method='post' action="{{route('producto.store')}}">
     @csrf

        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        name="nombre" type="text" maxlength="50"
                        placeholder="" value="{{old('nombre')}}" minlength="3"/>
                        <label for="nombre">Nombre del Producto</label>
                        @error('nombre')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select  class="form-control @error('categoria') is-invalid @enderror" name="categoria">
                        <option value="" >--seleccione una opcion--</option>
                        <option value="restaurante" @if(old('categoria') == "restaurante") {{ 'selected' }} @endif>Restaurante</option>
                        <option value="piscina" @if(old('categoria') == "piscina") {{ 'selected' }} @endif>Piscina</option>
                        <option value="siembras" @if(old('categoria') == "siembras") {{ 'selected' }} @endif>Siembras</option>
                        <option value="animales" @if(old('categoria') == "animales") {{ 'selected' }} @endif>Animales</option>
                        </select>
                        <label for="categoria">Categoría del Producto</label>
                        @error('categoria')
                            <small class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <div class="form-floating">
                        <textarea class="form-control @error('descripcion') is-invalid @enderror"
                            id="descripcion" name="descripcion" type="text" style="height:100px"
                            placeholder="" maxlength="150">{{old('descripcion')}}</textarea>
                        <label for="descripcion">Descripción del Producto</label>
                        @error('descripcion')
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
                                        ¿Está seguro de cancelar el registro del producto?
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
            </div>
        </div>
    </form>
@endsection

@section('footer')
@endsection
