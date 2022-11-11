<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href={{ asset("css/styles.css") }} rel="stylesheet" type="text/css">
        <title>Detalles de: {{$producto->nombre}}</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body style="background-color: rgba(60, 255, 0, 0.07)">
        <div class="container-fluid px-4">
            Restaurante
            <br><br>
            <div class="card shadow col-md-12 items-center">
                <h1 class="text-center">Detalles de: {{$producto->nombre}}<br></h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(81, 255, 0, 0.182)">
                                <tr>
                                    <th class="col-2">Datos</th>
                                    <th scope="col">Información</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Nombre del Producto:</th>
                                    <td>{{$producto->nombre}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción:</th>
                                    <td>{{$producto->descripcion}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Cantidad:</th>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <th scope="row">Precio:</th>
                                    <td >L. 1000.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr style="border: 2px solid rgb(5, 95, 0)">
                    <br>
                    <h3 style="color: rgb(12, 61, 0)">Historial de precios:</h3>
                    <div class="col-md-4" style="text-align: center">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(81, 255, 0, 0.182); text-align: center">
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($detalles as $d)
                                <tr>
                                  <th>{{$d->id}}</th>
                                  <th>{{$d->precio}} </th>
                                </tr>
                                @empty
                                 <tr>
                                   <td col-span="4">No hay Grados</td>
                                 </tr>
                              @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow col-md-12">
            <div class="card-body" style="text-align: right">
                <a class="btn btn-primary" href="{{route('inventario.index')}}">Volver</a>
                <a class="btn btn-warning" href="{{route('inventario.edit', ['id'=>$producto->id])}}">Editar</a>
            </div>
        </div>
        <br>
        <footer class="py-4 mt-auto" style="background-color: rgba(58, 215, 131, 0)">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; CENTRO TURISTICO VILLACRISOL 2022</div>
                </div>
            </div>
        </footer>
    </body>
</html>
