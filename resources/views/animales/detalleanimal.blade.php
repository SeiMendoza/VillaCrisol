<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href={{ asset("css/styles.css") }} rel="stylesheet" type="text/css">
        <title>Detalles de compra</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body>
        <div class="container-fluid px-4">
            <br><br>
            <div class="card shadow col-md-12 items-center">
                <h1 class="text-center">Detalles de compra<br></h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(0, 174, 255, 0.101)">
                                <tr>
                                    <th class="col-2">Datos</th>
                                    <th scope="col">Información</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">Nombre de proveedor:</th>
                                    <td>{{$animal->proveedor}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripcion:</th>
                                    <td>{{$animal->descripcion}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha de nacimiento:</th>
                                    <td>{{\Carbon\Carbon::parse($animal->nacimiento)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha de la compra:</th>
                                    <td>{{\Carbon\Carbon::parse($animal->fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total de la compra:</th>
                                    <td id="resultado"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr style="border: 2px solid rgb(5, 95, 0)">
                    <br>
                    <h3 style="color: rgb(12, 61, 0)">Listado de productos:</h3>
                    <div style="text-align: center">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(81, 255, 0, 0.182); text-align: center">
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Tipo de animal</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Compra</th>
                                    <th scope="col">Precio Venta</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $s = 0?>
                                @forelse($animal->detalle_compra as $item=> $d)
                                <tr>
                                    <th>{{++$item}}</th>
                                    <th>{{$d->datos->tipo}}</th>
                                    <th>{{$d->cantidad}}</th>
                                    <th>L.{{ number_format($d->precioCompra,2)}}</th>
                                    <th>L.{{ number_format($d->precioVenta,2)}}  </th>
                                    <th>L.{{ number_format($d->cantidad*$d->precioCompra,2)}}  </th>
                                    <?php $s += $d->cantidad*$d->precioCompra?>
                                   
                                </tr>
                                @empty
                                 <tr>
                                   <td col-span="4">No hay compras</td>
                                 </tr>
                              @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('resultado').innerHTML = 'L.{{ number_format($s,2)}}'
        </script>
        <br>
        <div class="card shadow col-md-12">
            <div class="card-body" style="text-align: right">
                <a class="btn btn-primary" href="{{route('compraAnimal.inventario')}}">Volver</a>
                <a class="btn btn-warning" href="{{route('animal.edit', ['id' => $animal->id])}}">Editar</a>
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
