@extends('plantillas.register')
@section('title', 'Editar el cliente')

@section('content')
    <h1 class="text-center">Cliente: {{$cliente->nombreCompleto}}</h1><br>

    <form method='post' action="{{route('clientes.update', ['id' => $cliente->id])}}">
    @method('put')
     @csrf

        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('nombreCompleto') is-invalid @enderror" id="nombreCompleto"
                        name="nombreCompleto" type="text" maxlength="50"
                        placeholder="" value="{{old('nombreCompleto', $cliente->nombreCompleto)}}" minlength="3"/>
                        <label for="nombreCompleto">Nombre Completo</label>
                        @error('nombreCompleto')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('numeroId') is-invalid @enderror" id="numeroId" name="numeroId" type="num"
                        value="{{old('numeroId', $cliente->numeroId)}}" maxlength="15" minlength="15"/>
                        <label for="numeroId">Número De Identidad</label>
                        @error('numeroId')
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
                        <input class="form-control @error('correo') is-invalid @enderror" id="correo"
                        name="correo" type="email" minlength="12" maxlength="50"
                        value="{{old('correo', $cliente->correo)}}" />
                        <label for="correo"> Correo Electrónico </label>
                        @error('correo')
                            <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control @error('numeroTelefono') is-invalid @enderror" id="numeroTelefono" name="numeroTelefono" type="tel"
                        value="{{old('numeroTelefono', $cliente->numeroTelefono)}}" maxlength="8" minlength="8"/>
                        <label for="numeroTelefono"> Número Telefónico</label>
                        @error('numeroTelefono')
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
                        <input class="form-control @error('domicilio') is-invalid @enderror" id="domicilio" name="domicilio" type="text"
                        value="{{old('domicilio', $cliente->domicilio)}}" maxlength="100" minlength="4"/>
                        <label for="domicilio ">Domicilio</label>
                        @error('domicilio')
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
                                ¿Está seguro de cancelar el registro del cliente?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <a href="{{route('clientes.index')}}" class="btn btn-primary">Si</a>
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
