@extends('plantillas.plantillaEmpleados')
@section('title', 'Registrar empleado')

@section('encabezado', 'Registro de empleados')
@section('content')
    
    
    <form method='post' action="{{route('empleado.crear')}}">
   
    @csrf

    <div class="modal-body">
     <div class="row mb-3">
     <div class="col-md-6">
    <div class="form-floating mb-3 mb-md-0">
     <input class="form-control @error('NombreCompleto') is-invalid @enderror" id="NombreCompleto"
      name="NombreCompleto" type="text" placeholder="" value="{{old('NombreCompleto')}}" maxlength="45"/>
      <label for="NombreCompleto">Nombre completo</label>
      @error('NombreCompleto')
      <small class="invalid-feedback">
     <strong>{{ $message }}</strong>
     </small>
      @enderror
     </div>
     </div> 
 
     <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('NúmeroDeIdentidad') is-invalid @enderror" id="NúmeroDeIdentidad" name="NúmeroDeIdentidad" type="num"
                    value="{{old('NúmeroDeIdentidad')}}" maxlength="15"/>
                    <label for="NúmeroDeIdentidad">Número De identidad</label>
                    @error('NúmeroDeIdentidad')
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
     <input class="form-control @error('CorreoElectrónico') is-invalid @enderror" id="CorreoElectrónico"
      name="CorreoElectrónico" type="text" 
     value="{{old('CorreoElectrónico')}}" maxlength="25"/>
      <label for="CorreoElectrónico"> Correo electrónico </label>
      @error('CorreoElectrónico')
      <small class="invalid-feedback">
     <strong>{{ $message }}</strong>
     </small>
      @enderror
     </div>
     </div> 

     <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('NúmeroTelefónico') is-invalid @enderror" id="NúmeroTelefónico" name="NúmeroTelefónico" type="text"
                    value="{{old('NúmeroTelefónico')}}" maxlength="8"/>
                    <label for="NúmeroTelefónico"> Número telefónico</label>
                    @error('NúmeroTelefónico')
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
     <input class="form-control @error('NúmeroDeReferencia') is-invalid @enderror" id="NúmeroDeReferencia"
      name=" NúmeroDeReferencia" type="text" 
     value="{{old('NúmeroDeReferencia')}}" maxlength="8"/>
      <label for="NúmeroDeReferencia"> Número contacto de la empresa</label>
      @error('NúmeroDeReferencia')
      <small class="invalid-feedback">
     <strong>{{ $message }}</strong>
     </small>
      @enderror
     </div>
     </div> 

     <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('NombreDeLaReferencia') is-invalid @enderror" id="NombreDeLaReferencia" name="NombreDeLaReferencia" type="text"
                     placeholder=""
                    value="{{old('NombreDeLaReferencia')}}" maxlength="45" />
                    <label for="NombreDeLaReferencia"> Nombre de contacto de la empresa</label>
                    @error('NombreDeLaReferencia')
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
     <input class="form-control @error('FechaDeIngreso') is-invalid @enderror" id="FechaDeIngreso"
      name="FechaDeIngreso" type="date" min="{{ now()->toDateString('Y-m-d') }}" max="{{ date("Y-m-d",strtotime(now()."+ 2 month"));}}"
       value="{{old('FechaDeIngreso')}}" />
      <label for="FechaDeIngreso">Fecha De Ingreso</label>
      @error('FechaDeIngreso')
      <small class="invalid-feedback">
     <strong>{{ $message }}</strong>
     </small>
      @enderror
     </div>
     </div> 
     
     <div class="col-md-6">
                <div class="form-floating">
                <select  class="form-control @error('Estado') is-invalid @enderror" name="Estado">   
                <option value="" >--seleccione una opcion--</option>
                <option value="temporal" @if(old('Estado') == "temporal") {{ 'selected' }} @endif>Temporal</option>
                <option value="permanente" @if(old('Estado') == "permanente") {{ 'selected' }} @endif>Permanente</option>
    </select>
                    <label for="Estado"> Estado </label>
                    @error('Estado')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            </div>
 
            <div class="col-md-6">
                <div class="form-floating">
             <input class="form-control @error('Domicilio') is-invalid @enderror" id="Domicilio" name="Domicilio" type="text"
             value="{{old('Domicilio')}}" maxlength="45"/>
                    <label for="Domicilio">Domicilio</label>
                     @error('Domicilio')
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
                            ¿Está seguro de cancelar el formulario?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="{{route('empleado.index')}}" class="btn btn-primary">Si</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </form>
    @endsection

 
 
 
