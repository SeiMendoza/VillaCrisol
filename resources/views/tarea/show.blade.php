@extends('tema.app')

@section('title','Ver')

@section('contenido')
    <h3>
        {{ $tarea->nombre }}
    </h3>
    <ul>
        <li>
            Perece: <strong>{{ $tarea->perece() }}</strong>
        </li>

        <li>
            Categoria: <strong>{{ $tarea->categoria }}</strong>
        </li>

        <li>
            Observacion: <strong>{{ $tarea->observacion }}</strong>
        </li>
    </ul>
    <p>
        {{ $tarea->descripcion }}
    </p>
    <hr>
    <div class="row">
        <div class="col-sm-12 mb-2">
            <form action="{{ route('tarea.destroy', $tarea) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm" type="submit">Borrar</button>
            </form>
        </div>
    </div>
@endsection


