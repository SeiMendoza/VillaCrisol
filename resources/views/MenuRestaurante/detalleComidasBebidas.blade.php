<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Detalles de: Comida X</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body style="background-color: rgba(0, 179, 0, 0.163)">
        <div class="container-fluid px-4">
            Menú
            <br><br>
            <div class="card shadow col-md-12 items-center">
                <h1 class="text-center">Comida X<br></h1>
                <div class="card-body" style="text-align: center">
                    <div>
                        <img class="" src="/imagenes/restaurante.jpg" width="300px" height="200px" alt="Imagen" />
                    </div>
                    <br>
                    <div class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, repellendus corrupti totam fuga rem esse
                        vero dignissimos expedita? Excepturi expedita assumenda quia alias reiciendis magnam esse sint error cumque odit!
                    </div>
                    <br>
                    <div class="table-responsive" style="background-color: rgba(0, 128, 0, 0.634);" >
                        <table class="table" style="color: white">
                        <tr>
                            <th scope= "col">Tipo: Comida </th>
                            <th scope= "col">Precio: L 120 </th>
                            <th scope= "col">Tamaño: Grande </th>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>

        <br>
        <div class="card shadow col-md-12" style="background-color: rgba(42, 142, 33, 0)" >
            <div class="card-body" style="text-align: center">
                <a class="btn btn-primary" href="{{route('menu.index')}}">Volver</a>
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
