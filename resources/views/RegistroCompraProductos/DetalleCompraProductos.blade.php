<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href={{ asset("css/styles.css") }} rel="stylesheet" type="text/css">
        <title>Detalles de compra: {{$detalles->numfactura}}</title>
        <link rel="shortcut icon" href="/crisol.png" type="image/x-icon">
    </head>
    <body style="background-color: rgba(60, 255, 0, 0.07)">
        <div class="container-fluid px-4">
            Restaurante
            <br><br>
            <div class="card shadow col-md-12 items-center">
                <h1 class="text-center">Detalles de compra: {{$detalles->numfactura}}<br></h1>
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
                                    <th scope="row">Numero de Factura:</th>
                                    <td>{{$detalles->numfactura}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Proveedor:</th>
                                    <td>{{$detalles->proveedor}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción:</th>
                                    <td>{{$detalles->descripción}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Categoria:</th>
                                    <td>{{$detalles->categoria}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha:</th>
                                    <td>{{\Carbon\Carbon::parse($detalles->fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
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
                    <h3 style="color: rgb(12, 61, 0)">Detalles de productos comprados:</h3>
                    <div class="col-md-12" style="text-align: center">
                        <table class="table">
                            <thead class="thead" style="background-color: rgba(81, 255, 0, 0.182); text-align: center">
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Impuesto</th>
                                    <th scope="col">Impuesto total</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sum=0?>
                                @forelse($detalles->detalle_compra as $producto)
                                    <?php $aux=0?>
                                    <tr>
                                        <td>{{$producto->producto->nombre}}</td>
                                        <td>{{$producto->cantidad}}</td>
                                        <td style="text-align: right">L.{{ number_format($producto->precio,2)}}</td>
                                        <?php $aux=$producto->precio*$producto->cantidad?>
                                        <td style="text-align: right">L.{{ number_format($aux,2)}}</td>
                                        <td>
                                            @if ($producto->impuesto != null)
                                                {{$producto->impuesto}}
                                            @else
                                                0.00
                                            @endif
                                        %</td>
                                        <td style="text-align: right">L.{{ number_format($aux*($producto->impuesto/100),2)}}</td>
                                        <?php $aux= $aux -(($producto->precio*$producto->cantidad)*($producto->impuesto/100)) ?>
                                        <td style="text-align: right">L.{{ number_format($aux,2)}}</td>
                                        <?php $sum+= $aux?>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan = "7" style="text-align: center">No hay productos registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <script>
                            document.getElementById('resultado').innerHTML = "L.{{ number_format($sum,2)}}";
                        </script>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow col-md-12">
            <div class="card-body" style="text-align: right">
                <a class="btn btn-primary" href="{{route('regcompra.index')}}">Volver</a>
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
