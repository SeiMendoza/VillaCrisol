@extends('plantillas.register1')
@section('title', 'Registro de compras')
@section('content')
    <style>
        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 100;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    @if(session('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session('mensaje')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="card shadow mb-4">
        <div class="card-header py-2" style="background: #0d6efd">
            <div style="float: left">
                <h2 class="m-0 font-bold" style="color: white">Registrar compras</h2>
            </div>

        </div>
    <form action="{{ route('regcompra.store') }}" id="formulario_compras" name="formulario_compras" method="POST">
        @csrf

        <div class="modal-body" style="font-family: 'Nunito', sans-serif; font-size: small; padding-top: 10px">
            <div class="page-content container-fluid">
                <div class="page-header text-blue-d2">

                <div class="container px-0">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <input class="form-control" name="compra_id" id="compra_id" type="text" value="{{$compra->id}}" hidden>
                                <!-- Nombre del cliente -->
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="numfactura" class="text-secondary-d1"><strong>Número de factura:</strong></label>
                                    <input class="form-control @error('numfactura') is-invalid @enderror" id="numfactura"
                                name="numfactura" type="num" maxlength="11" value="{{ old('numfactura') }}"
                                placeholder="Ingrese el codigo de factura"/>
                                @error('numfactura')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>

                                <!-- Nombre del vendedor -->
                                <div class="col-sm-2 mb-3 mb-sm-0">
                                    <label class="text-secondary-d1"><strong>Nombre del proveedor:</strong></label>
                                    <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                                name="proveedor" type="text" maxlength="45"
                                placeholder="Ingrese el proveedor" value="{{ old('proveedor') }}" />
                                @error('proveedor')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>
                                <div class="col-sm-2 mb-3 mb-sm-0">
                                    <label for="fecha" class="text-secondary-d1"><strong>Fecha de compra:</strong></label>
                                    <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                                name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
                                value="{{old('fecha')}}" />
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <label for="descripción" class="text-secondary-d1"><strong>Ingrese la descripción:</strong></label>
                                            <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción"
                                name="descripción" type="text" style="height:90px" placeholder="Ingrese la descripción de la compra"
                                maxlength="150">{{ old('descripción') }}</textarea>
                                @error('descripción')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                              </div>
                            </div>
                        </div>

                        <br>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="input-group">
                                        <input type="text" name="buscar_producto" id="buscar_producto"
                                               class="form-control border-1 small" placeholder="Buscar producto"
                                               aria-label="Search" aria-describedby="basic-addon2" style=""  onkeyup="filtrar_productos()">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-5 mb-3 mb-sm-0">
                                    <!-- Catalogo de Productos -->
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        <!-- Catalogo de Productos -->
                                        <div class="table-responsive" style=" height: 500px; overflow:scroll;  float:left; ">
                                            <section class="NovidadesSection">
                                                <div class="producto" id="producto"
                                                     style="display: grid; grid-template-columns: 140px 140px 140px;">
                                                    @foreach($productos as $pro)
                                                        <div class="agregar-factura" id="agregar-fac" name="agregar-fac"
                                                             style="display:block;  height: 100px; width: 140px; padding: 3px ">
                                                            <div class="card h-100 btn btn-agregar">
                                                                <div class="" style="text-align:center;">
                                                                    <div class="text-center">
                                                                        <!-- id -->
                                                                        <a href="#" class="id-p" id="id" data-id="{{$pro->id}}" style="display: none"></a>
                                                                        <!-- name -->
                                                                        <h4 class="nombre" id="nombre">
                                                                            <strong style="font-size: 12px">{{$pro->nombre}}</strong>
                                                                        </h4>
                                                                        <!-- categ -->
                                                                        <div class="cat">
                                                                            <span id="c" class="pre text-muted text-decoration-line">
                                                                                <strong style="font-size: 10px">{{$pro->categoria}}</strong>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-7 mb-3 mb-sm-0" style="padding: 2px; height: 500px; ">
                                    <div class="table-responsive" style=" height: 400px; overflow:scroll;" id="carrito">
                                        <table class="table" id="lista-compra">
                                            <thead class="bg-none bgc-default-tp1">
                                            <tr class="text-white">
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Impuesto</th>
                                            <th>Total</th>
                                            <th>Eliminar</th>
                                            </tr>
                                            <tbody>

                                                     <input type="text" name="tuplas" class="form-control @error('tuplas') is-invalid @enderror"
                                                     id="tuplas" hidden>
                                                     @error('tuplas')
                                                    <small class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                    @enderror
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                            <div class="d-flex flex-row justify-content-center">

                                                <a href="#" onclick="guardar_compra()" id="procesar-compra"
                                                class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0 mr-2">Guardar</a>

                                             <a href="{{route('regcompra.index')}}" onclick="cancelar()" id="cancelar"
                                                class="btn btn-danger btn-bold px-4 float-right mt-2 mt-lg-0 mr-2">Cancelar</a>

                                        </div>
                                        </div>
                                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                            <div class=" row my-2 align-items-center bgc-primary-l3 p-2">
                                                <div class="total">
                                                    Total
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-150 text-success-d3 opacity-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </form>
    <script>
        let productos = @json($productos);
        let busqueda = [];
        function filtrar_productos() {
            let textobusqueda = document.getElementById("buscar_producto").value;
            busqueda = [];
            productos.forEach(function(product){
                let texto = product.nombre;
                if(texto.toLowerCase().includes(textobusqueda.toLowerCase())){
                    busqueda.push(product);
                }
            });

            let contenedor = document.getElementById('producto');
            contenedor.innerHTML = '';

            busqueda.forEach(function(params) {

                let componente =  ' <div class="agregar-factura" id="agregar-fac" name="agregar-fac"\
                                                             style="display:block;  height: 100px; width: 140px; padding: 3px ">\
                                                            <div class="card h-100 btn btn-agregar">\
                                                                <div class="" style="text-align:center;">\
                                                                    <div class="text-center">\
                                                                        <!-- id -->\
                                                                        <a href="#" class="id-p" id="id" data-id="'+params.id+'" \
                                                                            style="display: none"></a>\
                                                                        <!-- name -->\
                                                                        <h4 class="nombre" id="nombre">\
                                                                            <strong style="font-size: 12px">'+params.nombre+'</strong>\
                                                                        </h4>\
                                                                        <!-- categ -->\
                                                                        <div class="cat">\
                                                                            <span id="c" class="pre text-muted text-decoration-line">\
                                                                                <strong style="font-size: 10px">'+params.categoria+'</strong>\
                                                                            </span>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>';
                contenedor.innerHTML+=componente;
            });
        }

        function buscar() {
            var impu_buscar = document.getElementById("buscar_producto");
            window.location.href;
        }

        function cancelar() {
            var c = document.getElementById('cancelar');
            localStorage.clear();
        }

       function guardar_compra() {
            const carr = new Carrito();
            var formul = document.getElementById("formulario_compras");
            var fecha = document.getElementById('fecha');
            var descripcion = document.getElementById('descripción');

            let productoLS;
            productoLS = carr.obtenerProductoLS();

            for (let i = 0; i < productoLS.length; i++) {
                if (Number(productoLS[i].precio) != "" && Number(productoLS[i].precio) > 0 && fecha.value != "" && descripcion.value != "") {
                formul.submit();
                    localStorage.clear();
                }else {
                Swal.fire({
                type: 'info',
                title: 'Oops...',
                text: 'falta un dato',
                showConfirmButton: false,
                timer: 2000 });
                }
            }

        }
    </script>

    <script src="{{ asset("js/carrito.js") }}"></script>
    <script src="{{ asset("js/compra.js") }}"></script>
@endsection



