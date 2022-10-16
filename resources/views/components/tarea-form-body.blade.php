@csrf
        <div class="row">
            <div class="col-sm-12">
                <label for="InputNombre" class="form-label">Nombre del producto</label>
                <input type="text" name="nombre" id="InputNombre" class="form-control" placeholder="Nombre" value="{{ old('nombre', $tarea->nombre) }}">
            </div>
            <div class="col-sm-12">
                <label for="TextAreaDescripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="TextAreaDescripcion" cols="30" rows="10" class="form-control">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>
            <div class="col-sm-4">
                <label for="SelectPerece" class="form-label">Perece</label>
                <select name="perece" id="SelectPerece" class="form-select">
                    @for ($x = 0; $x < count($perece); $x++)
                    <option value="{{ $x }}" @selected(old('perece', $tarea->perece))>{{ $perece[$x] }}</option>
                     @endfor
                </select>

            </div>
            <div class="col-sm-12">
                <label for="InputCategoria" class="form-label">Categoria</label>
                <input type="text" name="categoria" id="InputCategoria" class="form-control" placeholder="" value="{{ old('categoria', $tarea->categoria) }}">
            </div>
            <div class="col-sm-12">
                <label for="InputObservacion" class="form-label">Observaciones</label>
                <input type="text" name="observacion" id="InputObservacion" class="form-control" placeholder="" value="{{ old('observacion', $tarea->observacion) }}">
            </div>
            <div class="col-sm-12 text-end my-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
