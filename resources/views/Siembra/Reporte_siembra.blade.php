<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reporte de Siembra</title>
    <!-- CSS Bootstrap 5.2 -->
    <link href={{ asset("css/bootstrap.min.css") }} rel="stylesheet" type="text/css" media="screen"/>
</head>
<body >
   <div class="col">
  <div class="text-center text-150">
      <span class="titulo">Villa-Crisol</span>
      </div>
 </div>
      <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <!-- or use a table instead -->
            <div class="table-responsive" id="tblaBody">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <tbody class="text-95 text-secondary-d3">
                    <tr class="emc" style="text-align:center;">
                            <th scope="col">Numero</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $item => $producto)
                                <tr style="text-align: center;">
                                        <td><strong>{{ $item+1 + ( 10 * ($productos->currentPage()-1)) }}</strong></td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->existencia}}</td>
                                        <td style="text-align:center">L.{{ number_format($producto->precio,2)}}</td>
                                        <td style="text-align:center">L.{{$producto->precio*$producto->existencia}}</td>
                                </tr>
                            @empty
                            @endforelse
                    </tbody>
                </table>
            </div>
             
   <hr />    
</body>
</html>