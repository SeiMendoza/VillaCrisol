@extends('plantillas.register')
@section('title', 'Registrar Animales')

@if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@section('encabezado', 'Registro de animales')
@section('content')

    <form method='post' action="{{route('animal.store')}}">
     @csrf

        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('tipo') is-invalid @enderror" id="tipo"
                        name="tipo" type="text" maxlength="50"
                        placeholder="" value="{{old('tipo')}}" minlength="3"/>
                        <label for="tipo">Tipo de animal</label>
                        @error('tipo')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <select class="form-control @error('proposito') is-invalid @enderror" id="proposito"
                        name="proposito">
                        <option value="" >--seleccione una opcion--</option>
                        <option value="consumo" @if(old('proposito') == "consumo") {{ 'selected' }} @endif>Consumo</option>
                        <option value="producción" @if(old('proposito') == "producción") {{ 'selected' }} @endif>Producción</option>
                        <option value="doméstico" @if(old('doméstico') == "doméstico") {{ 'selected' }} @endif>Doméstico</option>
                    </select>
                        <label for="proposito">Propósito</label>
                        @error('proposito')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                        name="descripcion" type="text" maxlength="100"
                        placeholder="" value="{{old('descripcion')}}" minlength="3"/>
                        <label for="descripcion">Descripción</label>
                        @error('descripcion')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <select class="form-control @error('sexo') is-invalid @enderror" id="sexo"
                        name="sexo" value="{{old('sexo')}}">
                        <option value="" >--seleccione una opcion--</option>
                        <option value="macho" @if(old('sexo') == "macho") {{ 'selected' }} @endif>Macho</option>
                        <option value="hembra" @if(old('sexo') == "hembra") {{ 'selected' }} @endif>Hembra</option>
                        
                    </select>
                        <label for="sexo">Seleccione el sexo</label>
                        @error('sexo')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('raza') is-invalid @enderror" id="raza"
                        name="raza"  type="text" maxlength="100"
                        placeholder="" value="{{old('raza')}}" minlength="3"/>
                        <label for="raza">Raza</label>
                        @error('raza')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
            <div class="col-md-12">
            <div class="card-body" style="text-align: center">
                        <button class="btn btn-primary mt-10" type="submit">Guardar</button>
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
                                        ¿Está seguro de cancelar el registro del animal?
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
