<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detalles de: {{$empleado-> NombreCompleto }}</title>
</head>
<body>
    <br><br>
<h1 class="text-center">Detalles de: {{$empleado-> NombreCompleto }}<br></h1>
<div class="container">
    <div class="col-sm12 col-md-12 col-lg-9">
<table class="table">
    <thead class="thead-light ">
        <tr> 
            <th scope="col">campo</th>
            <th scope="col">valor</th>
            <th scope=""><a class="btn btn-warning" href="{{route('empleado.editar', ['id'=>$empleado->id])}}">Editar</a></th>
        </tr>
    </thead>
    <body>
        
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
        <th scope="row">Nombre Referencia:</th>
        <td>{{$empleado->NombreDeLaReferencia}}</td>
    </tr>
    <tr>
        <th scope="row">Número Referencia:</th>
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

<a class='btn btn-primary' href="{{route('empleado.index')}}">volver</a>
</div>