@extends('plantillas.register')
@section('title', 'Registro de Comidas y Bebidas')

@section('encabezado', 'Registro de Comidas y Bebidas')
@section('content')
<form method='post' action="{{route('menu.update',['id'=>$comidabebidas->id])}}">
    @method('put')
    @csrf
    <div class="modal-body">
    <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control @error('Nombre') is-invalid @enderror" id="Nombre"
                     name="Nombre" type="text" maxlength="45"
                    placeholder=""  value="{{old('Nombre',$comidabebidas->Nombre)}}" />
                    <label for="Nombre">Nombre</label>
                    @error('NombrePlato')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('Descripción') is-invalid @enderror" id="Descripción" name="Descripción" type="text"
                     placeholder="" maxlength="45"
                     value="{{old('Descripción',$comidabebidas->Descripción)}}" />
                    <label for="Descripción">Descripción</label>
                    @error('Descripción')
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
                <select  class="form-control @error('Tipo') is-invalid @enderror" name="Tipo">   
                <option value="">--seleccione--</option>
                <option value="Bebida">Bebida</option>
                <option value="Plato">Plato</option>
                <option value="Combo">Combo</option>
                </select>
<label for="Tipo">seleccione un Tipo</label>
                    @error('Tipo')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('Precio') is-invalid @enderror" id="Precio" name="Precio" type="text"
                     placeholder="" maxlength="10"
                     value="{{old('Precio',$comidabebidas->Precio)}}"/>
                    <label for="Precio">Precio</label>
                    @error('Precio')
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
                <select  class="form-control @error('TamañoBebida') is-invalid @enderror" name="Tamaño">   
                <option value="">--seleccione un Tamaño--</option>
                <option value="Personal">Personal</option>
                <option value="3 personas">3 personas</option>
                <option value="Familiar">Familiar</option>
</select>
<label for="Tamaño">seleccione un Tamaño</label>
                    @error('Tamaño')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('Imagen') is-invalid @enderror" id="Imagen" name="Imagen" type="file"
                     placeholder=""
                     value="{{old('Imagen',$comidasbebidas->Imagen)}}"/>
                    <label for="Imagen">Seleccione Una Imagen</label>
                    @error('Imagen')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
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
                            ¿Está seguro de cancelar los cambios?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="{{route('menu.index')}}" class="btn btn-primary">Si</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </form>
    @endsection

 
 
 
