<div>
    <div class="row">
        <div class="col-sm-8">
            <input type="text" name="" id="" placeholder="Buscar" class="form-control" wire:model="busqueda">
        </div>
        <div class="col-sm-3">
            <select name="" id="" class="form-select" wire:model="paginacion">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Descripción
                </th>
                <th>
                    Perece
                </th>
                <th>
                    Categoria
                </th>
                <th>
                    Observación
                </th>
                <th>
                    Editar/Ver
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
                <tr>
                    <td>
                        {{ $tarea->nombre }}
                    </td>
                    <td>
                        {{ $tarea->descripcion }}
                    </td>
                    <td>
                        {{ $tarea->perece() }}
                    </td>
                    <td>
                        {{ $tarea->categoria }}
                    </td>
                    <td>
                        {{ $tarea->observacion }}
                    </td>
                    <td>
                        <a href="{{ route('tarea.edit', $tarea) }}">Editar</a>
                        <a href="{{ route('tarea.show', $tarea) }}">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tareas->links() }}
</div>
