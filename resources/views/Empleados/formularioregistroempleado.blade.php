@extends('plantillas.plantillaEmpleados')
@section('title', 'Registrar Empleado')

@section('encabezado', 'Registro de Empleados')
@section('content')
    
    
    <form method='post' action="{{route('empleado.crear')}}">
   
    @csrf

    <div class="modal-body">
     <div class="row mb-3">
     <div class="col-md-6">
    <div class="form-floating mb-3 mb-md-0">
     <input class="form-control @error('NombreCompleto') is-invalid @enderror" id="NombreCompleto"
      name="NombreCompleto" type="text"required autocomplete="NombreCompleto"
      placeholder="" value="{{old('NombreCompleto')}}" />
      <label for="NombreCompleto">Nombre Completo</label>
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
                    value="{{old('NúmeroDeIdentidad')}}" />
                    <label for="NúmeroDeIdentidad">Número De Identidad</label>
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
      name="CorreoElectrónico" type="text"required autocomplete=" "
     value="{{old('CorreoElectrónico')}}" />
      <label for="CorreoElectrónico"> Correo Electrónico </label>
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
                    value="{{old('NúmeroTelefónico')}}" />
                    <label for="NúmeroTelefónico"> Número Telefónico</label>
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
      name=" NúmeroDeReferencia" type="text"required autocomplete=" "
     value="{{old('NúmeroDeReferencia')}}" />
      <label for="NúmeroDeReferencia"> Número De Referencia</label>
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
                    value="{{old('NombreDeLaReferencia')}}" />
                    <label for="NombreDeLaReferencia"> Nombre De La Referencia</label>
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
      name="FechaDeIngreso" type="date"required autocomplete="FechaDeIngreso"
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
                <option value="">--seleccione una opcion--</option>
                <option value="{{old('Estado')}}">temporal</option>
                <option value="{{old('Estado')}}">permanente</option>
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
             <input class="form-control @error(' Domicilio') is-invalid @enderror" id="Domicilio" name="Domicilio" type="text"
             value="{{old('Domicilio')}}" />
                    <label for="Domicilio ">Domicilio</label>
                     @error('Domicilio ')
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
                            ¿Está seguro de cancelar los cambios?
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
