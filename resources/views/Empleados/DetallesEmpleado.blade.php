<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Detalles de: {{$empleado-> NombreCompleto }}</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body>
        <div class="container-fluid px-4">
            Empleados
            <br><br>
            <div class="card shadow col-md-12 items-center">
                <h1 class="text-center">Detalles de: {{$empleado-> NombreCompleto }}<br></h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(0, 174, 255, 0.101)">
                                <tr>
                                    <th scope="col">Datos</th>
                                    <th scope="col">Información</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">Nombre completo:</th>
                                    <td>{{$empleado->NombreCompleto}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Número de identidad:</th>
                                    <td>{{$empleado->NúmeroDeIdentidad}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Correo electrónico:</th>
                                    <td>{{$empleado->CorreoElectrónico}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telefono:</th>
                                    <td>{{$empleado->NúmeroTelefónico}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre contacto de la empresa:</th>
                                    <td>{{$empleado->NombreDeLaReferencia}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Número contacto de la empresa:</th>
                                    <td>{{$empleado->NúmeroDeReferencia}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Domicilio:</th>
                                    <td>{{$empleado->Domicilio}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha ingreso:</th>
                                    <td>{{$empleado->FechaDeIngreso}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Estado del empleado:</th>
                                    <td>{{$empleado->Estado}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow col-md-12" style="background-color: rgba(42, 142, 33, 0)" >
            <div class="card-body" style="float">
                <a class="btn btn-primary" style="float: left" href="{{route('empleado.index')}}">Volver</a>
                <a class="btn btn-warning" style="float: right" href="{{route('empleado.editar', ['id'=>$empleado->id])}}">Editar</a>
            </div>
        </div>
        <br>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; CENTRO TURISTICO VILLACRISOL 2022</div>
                </div>
            </div>
        </footer>
    </body>
</html>
