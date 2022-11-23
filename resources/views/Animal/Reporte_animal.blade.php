<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reporte de Animal</title>
  <style>
    h1{
        text-align: center;
    }
    .tabla{
        text-align: center;
        width: 100%;
    }
    .color{
        background: green;
    }
    .izq{
        text-align: left;
    }
    .color1{
        background: gainsboro;
    }
  </style>
</head>
<body>
  <div>
      <h1>Villa-Crisol</h1>
      </div>
      <h3 class="izq">Reporte de busqueda en inevtario de animal</h3>
      <hr/>
                    <!-- or use a table instead -->
            <div>
                <table class="tabla">
                    <tbody>
                    <tr class="color">
                            <th scope="col">Número</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $item => $producto)
                                <tr class="color1">
                                        <td>{{ $item+1 + ( 10 * ($productos->currentPage()-1)) }}</td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->existencia}}</td>
                                        <td style="text-align:center">L.{{ number_format($producto->precio,2)}}</td>
                                        <td style="text-align:center">L.{{$producto->precio*$producto->existencia}}</td>
                                </tr>
                            @empty
                            <tr><td colspan = "7" style="text-align: center">No hay productos registrados</td>
                                    </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
   <hr />    
</body>
</html>