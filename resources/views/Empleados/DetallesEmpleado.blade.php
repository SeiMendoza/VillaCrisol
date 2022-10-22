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
                            <thead class="thead-light ">
                                <tr>
                                    <th scope="col">Datos</th>
                                    <th scope="col">Información</th>
                                    <th scope=""><a class="btn btn-warning" href="{{route('empleado.editar', ['id'=>$empleado->id])}}">Editar</a></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">Nombre Completo:</th>
                                    <td>{{$empleado->NombreCompleto}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Número De Identidad:</th>
                                    <td>{{$empleado->NúmeroDeIdentidad}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Correo Electrónico:</th>
                                    <td>{{$empleado->CorreoElectrónico}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telefono:</th>
                                    <td>{{$empleado->NúmeroTelefónico}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre Contacto de la Empresa:</th>
                                    <td>{{$empleado->NombreDeLaReferencia}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Número Contacto de la Empresa:</th>
                                    <td>{{$empleado->NúmeroDeReferencia}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Domicilio:</th>
                                    <td>{{$empleado->Domicilio}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha Ingreso:</th>
                                    <td>{{$empleado->FechaDeIngreso}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Estado del Empleado:</th>
                                    <td>{{$empleado->Estado}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow col-md-12">
            <div class="card-body" style="text-align: center">
                <a class='btn btn-primary' href="{{route('empleado.index')}}">volver</a>
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
