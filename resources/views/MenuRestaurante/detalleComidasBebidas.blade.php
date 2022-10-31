<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Detalles de: {{$comidaBebida->Nombre}}</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body style="background-color: rgba(60, 255, 0, 0.07)">
        <div class="container-fluid px-4">
            Menú
            <br><br>
            <div class="card shadow col-md-12">
                <h1 class="text-center">{{$comidaBebida->Nombre}}<br></h1>
                <div class="card-body" style="text-align: center">
                    <div>
                        <img class="" src="/imagenes/menu/{{$comidaBebida->Imagen}}" width="300px" height="200px" alt="Imagen" />
                    </div>
                    <br>
                    <div class="text-center">
                        {{$comidaBebida->Descripción}}
                    </div>
                    <br>
                    <div style="background-color: rgba(25, 163, 25, 0.553);" >
                        <table class="table" style="color: white;">
                        <tr>
                            <th  scope= "col" colspan="1">Tipo: {{$comidaBebida->Tipo}} </th>
                            <th></th>
                            <th  scope= "col" colspan="1">Precio: L {{$comidaBebida->Precio}}</th>
                            <th  scope= "col" colspan="1">Tamaño: {{$comidaBebida->Tamaño}} </th>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow col-md-12">
            <div class="card-body" style="text-align: right">
                <a class="btn btn-primary" href="{{route('menu.index')}}">Volver</a>
                <a class="btn btn-warning" href="{{route('menu.editar', ['id'=>$comidaBebida->id])}}">Editar</a>
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
