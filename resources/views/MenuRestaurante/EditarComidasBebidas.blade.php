@extends('plantillas.register')
@section('title', 'Editar comidas y bebidas')

 
@section('content')
<h1 class="text-center">Editando a: {{$comidabebidas->Nombre}}</h1><br>

<form method='post' action="{{route('menu.update',['id'=>$comidabebidas->id])}}" enctype="multipart/form-data">
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
                    @error('Nombre')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                <select  class="form-control @error('Tamaño') is-invalid @enderror" name="Tamaño">
                <option value="personal"{{$comidabebidas->Tamaño =="pesonal" ? 'selected' :''}} >Personal</option>
                <option value="2 personas"{{$comidabebidas->Tamaño =="2 personas" ? 'selected' :''}} >2 personas</option>
                <option value="familiar"{{$comidabebidas->Tamaño =="familiar" ? 'selected' :''}} >Familiar</option>
</select>
<label for="Tamaño">seleccione un tamaño de menú </label>
                    @error('Tamaño')
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
                <option value="bebida"{{$comidabebidas->Tipo =="bebida" ? 'selected' :''}} >Bebida</option>
                <option value="comida"{{$comidabebidas->Tipo =="comida" ? 'selected' :''}} >Comida</option>
                <option value="combo"{{$comidabebidas->Tipo =="combo" ? 'selected' :''}} >Combo</option>
                </select>
<label for="Tipo">seleccione un tipo de menú </label>
                    @error('Tipo')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('Precio') is-invalid @enderror" id="Precio" name="Precio" type="num"
                     placeholder="" maxlength="3"
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
                <textarea class="form-control @error('Descripción') is-invalid @enderror" id="Descripción" name="Descripción" type="text"
                  maxlength="150" style="height:145px">{{old('Descripción',$comidabebidas->Descripción)}}</textarea>
                    <label for="Descripción">Descripción del menú </label>
                    @error('Descripción')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control @error('Imagen') is-invalid @enderror" id="Imagen" name="Imagen" type="file"
                     placeholder="" value="{{old('Imagen',$comidabebidas->Imagen)}}"/> 
                     <div class="grid grid-cols-1 mt-3 mx-5">
                    <img src="/imagenes/menu/{{$comidabebidas->Imagen}}" width="200px" id="imagenSeleccionada">
                </div> 
                    <label for="Imagen">Seleccione una imagen</label>
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
     

    <script>
                const $seleccionArchivos = document.querySelector("#Imagen"),
                $imagenPrevisualizacion = document.querySelector("#imagenSeleccionada");

                // Escuchar cuando cambie
                $seleccionArchivos.addEventListener("change", () => {
                // Los archivos seleccionados, pueden ser muchos o uno
                const archivos = $seleccionArchivos.files;
                // Si no hay archivos salimos de la función y quitamos la imagen
                if (!archivos || !archivos.length) {
                    $imagenPrevisualizacion.src = "";
                    return;
                }
                // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                const primerArchivo = archivos[0];
                // Lo convertimos a un objeto de tipo objectURL
                const objectURL = URL.createObjectURL(primerArchivo);
                // Y a la fuente de la imagen le ponemos el objectURL
                $imagenPrevisualizacion.src = objectURL;
                });
            </script>

@endsection
