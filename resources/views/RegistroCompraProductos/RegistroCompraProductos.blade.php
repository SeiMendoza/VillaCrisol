@extends('plantillas.index')
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
    <div class="card shadow mb-4">
        <div class="card-header py-2" style="background: #0d6efd">
            <div style="float: left">
                <h2 class="m-0 font-bold" style="color: white">Registrar compras</h2>
            </div>

        </div>
    <form action="{{ route('regcompra.store') }}" id="" name="form" method="POST">
        @csrf

        <div class="modal-body" style="font-family: 'Nunito', sans-serif; font-size: small; padding-top: 10px">
            <div class="page-content container-fluid">
                <div class="page-header text-blue-d2">
                
                <div class="container px-0">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="numfactura" class="text-secondary-d1"><strong>Número de factura:</strong></label>
                            <input  type="text" name="compra_id" id="compra_id" value="{{$compra->id}}" hidden>
                                <input class="form-control @error('numfactura') is-invalid @enderror" id="numfactura"
                                name="numfactura" type="num" maxlength="11" value="{{ old('numfactura') }}"
                                placeholder="Ingrese el codigo de factura"/>
                                @error('numfactura')
                                    <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                 
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="proveedor" class="text-secondary-d1"><strong>Nombre del proveedor:</strong></label>
                                    <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                                name="proveedor" type="text" maxlength="45"
                                placeholder="Ingrese el proveedor" value="{{ old('proveedor') }}" />
                                @error('proveedor')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                              
                                <div class="col-sm-2 mb-3 mb-sm-0">
                                    <label for="fecha" class="text-secondary-d1"><strong>Fecha de registro:</strong></label>
                                    <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                                name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
                                value="{{old('fecha')}}" />
                                @error('fecha')
                                    <small class="invalid-feedback" >
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                 
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="categoria" class="text-secondary-d1"><strong>Seleccione una categoría:</strong></label>
                                            <select  class="form-control @error('categoria') is-invalid @enderror" name="categoria">
                                    <option value="">--seleccione una categoría--</option>
                                    <option value="restaurante" @if(old('categoria') == "restaurante") {{ 'selected' }} @endif>Restaurante</option>
                                    <option value="piscina" @if(old('categoria') == "piscina") {{ 'selected' }} @endif>Piscina</option>
                                    <option value="siembra" @if(old('categoria') == "siembra") {{ 'selected' }} @endif>Siembra</option>
                                    <option value="animales" @if(old('categoria') == "animales") {{ 'selected' }} @endif>Animales</option>
                                </select>
                                @error('categoria')
                                    <small class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>

                                 
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <label for="descripcion" class="text-secondary-d1"><strong>Descripción de la compra:</strong></label>
                                    <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción"
                                name="descripción" type="text" style="height:100px" placeholder="Ingrese la descripción de la compra"
                                maxlength="150">{{ old('descripción') }}</textarea>
                                @error('descripción')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="input-group">
                                        <input type="text" name="buscar_producto" id="buscar_producto"
                                               class="form-control border-0 small" placeholder="Buscar producto"
                                               aria-label="Search" aria-describedby="basic-addon2" style=""  onkeyup="filtrar_productos()">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <!-- Catalogo de Productos -->
                                    <div class="table-responsive" style=" height: 400px; overflow:scroll;  float:left; ">
                                        <section class="NovidadesSection">

                                            <div class="producto" id="producto"
                                                 style="display: grid; grid-template-columns: 140px 140px 140px 140px;">

                                                @foreach($productos as $pro)
                                                    <div class="agregar-factura" id=""
                                                         style="display:block;  height: 170px; width: 140px; padding: 3px ">
                                                        <div class="card h-100 btn" data-id="{{$pro->id}}">
                                                            
                                                             
                                                            <div class="" style="text-align:center ;">
                                                                <div class="text-center">
                                                                    <!-- Nombre del producto -->
                                                                    <p class="nombre" id="nombre">
                                                                        <strong style="font-size: 18px">{{$pro->nombre}}</strong>
                                                                    </p>
                                                                    <!-- Precio del producto-->
                                                                    <div class="p">
                                                                        <span id="pre" class="pre text-muted text-decoration-line">
                                                                            <strong style="font-size: 15px">{{$pro->categoria}}</strong>
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

                                <div class="col-sm-5 mb-3 mb-sm-0" style="padding: 3px; height: 400px; overflow:scroll;">
                                    <div class="table-responsive" style=" height: 400px; overflow:scroll;" >
                                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                            <thead class="bg-none bgc-default-tp1">
                                            <tr class="text-white">
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Impuesto</th>
                                            <th>Total</th>
                                            <th style="text-align:center;" colspan="3">Opciones</th>
                                            </tr>
                                            </thead>

                                            <tbody id="content-fac" class="content-fac">
                                            </tbody>
                                            <input type="text" name="tuplas" hidden>
                                        </table>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                               
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

                                        <hr/>

                                        <div class="d-flex flex-row justify-content-center">

                                            <input type="text" name="pagado" hidden>

                                            <a href="#" onclick="guardar_venta_pagada()"
                                               class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0 mr-2">Guardar y Pagar</a>

                                            <a href="#" onclick="guardar_compra()"
                                               class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0 mr-2">Guardar</a>

                                            <a href="/compras"
                                               class="btn btn-danger btn-bold px-4 float-right mt-2 mt-lg-0 mr-2">Cancelar</a>

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
                let texto = product.marca + " " + product.modelo;
                if(texto.toLowerCase().includes(textobusqueda.toLowerCase())){
                    busqueda.push(product);
                }
            });

            let contenedor = document.getElementById('producto');
            contenedor.innerHTML = '';

            busqueda.forEach(function(params) {

                let componente =  '<div class="agregar-factura" id="" \
                                    style="display:block;  height: 170px; width: 140px; padding: 3px">\
                                    <div class="card h-100 btn" data-id="'+params.id+'">\
                                                            <!-- Cantidad en existencia -->\
                                                            <div class="badge bg-dark text-white position-absolute"\
                                                                 style="top: 0.5rem; right: 0.5rem">\
                                                                 '+params.existencia+' unidades\
                                                            </div>\
                                                            <!-- Imagen del producto-->\
                                                            <img class="card-img-top"\
                                                                 src="/images/products/'+params.imagen_producto+'"\
                                                                 width="00px"\
                                                                 height="80px" alt="..."/>\
                                                            <div class="" style="text-align:center ;">\
                                                                <div class="text-center">\
                                                                    <!-- Nombre del producto -->\
                                                                    <p class="nombre" id="nombre">\
                                                                        <strong style="font-size: 12px">'+params.marca+' '+params.modelo+'</strong>\
                                                                    </p>\
                                                                    <!-- Precio del producto-->\
                                                                    <div class="p">\
                                                                        <span id="pre" class="pre text-muted text-decoration-line">\
                                                                            <strong style="font-size: 15px"> L. '+params.prec_venta_fin+'</strong>\
                                                                        </span>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>';
                contenedor.innerHTML+=componente;

                const Clickbutton = document.querySelectorAll('.btn');

                Clickbutton.forEach(btn => {
                    btn.addEventListener('click', addFactura);
                });
            });



        }
        function buscar() {
            var impu_buscar = document.getElementById("buscar_producto");
            window.location.href = " ";
        }


        function guardar_compra() {
            var formul = document.getElementById("form")

            formul.submit();
        }

        function guardar_venta_pagada() {
            var formul = document.getElementById("formulario_ventas")
            formul.pagado.value = "true"
            formul.submit();
        }

        

        const Clickbutton = document.querySelectorAll('.btn');
        const tbody = document.querySelector('#content-fac');
        let factura = [];
        let db = document.getElementById('producto')


        Clickbutton.forEach(btn => {
            btn.addEventListener('click', addFactura);
        });

        function addFactura(e) {
            const boton = e.target;
            console.log(boton);
            const item = boton.closest('.agregar-factura');
            const itemTitulo = item.querySelector('.nombre').textContent;

            const itemPrecio = item.querySelector('#pre').textContent;
            const itemId = item.querySelector(".btn").getAttribute('data-id');

            const newProducto = {
                id: itemId,
                titulo: itemTitulo,
                cantidad: 1,
                precio: itemPrecio
            }
            addItemfactura(newProducto);
        }

        function addItemfactura(newProducto) {
            const inputEle = tbody.getElementsByClassName('input_Element');
            for (let i = 0; i < factura.length; i++) {
                if (factura[i].id.trim() === newProducto.id.trim()) {
                    factura[i].cantidad++;
                    const input = inputEle[i];
                    input.value++;
                    total()
                    renderFactura()
                    return null;
                }
            }
            factura.push(newProducto);
            renderFactura();
        }

        function renderFactura() {
            tbody.innerHTML = '';

            var i = 0;
            factura.map(item => {

                const tr = document.createElement('tr');
                tr.classList.add('itemFac');
                var total_producto = Number(item.precio.replace("L.", "")) * Number(item.cantidad);
                const Content = `
                            <td colspan="3" class="titulo">${item.titulo}</td>
                            <td>
                                <input onchange="renderFactura()" type="number" min="1" style ="width :40px;" value ="${item.cantidad}" class="input_Element"> </input>
                            </td>
                            <td  width="140">${item.precio}</td>
                            <td  width="140">${total_producto.toFixed(2)}</td>

                            <td  width="140">
                                <a href="#" class="borrar-producto   fas fa-times-circle" data-id="${item.id}"></a>
                            </td>
                                <input name="detalle-` + i + `" type="text" value="${item.id} ${item.cantidad}" readonly style="display:none">
                            `;

                tr.innerHTML = Content;
                tbody.append(tr);

                tr.querySelector(".borrar-producto").addEventListener('click', QuitarItemCarrito);
                tr.querySelector(".input_Element").addEventListener('change', cambCant);

                i++;
            });

            document.formulario_ventas.tuplas.value = factura.length;
            total()
        }

        function total() {
            let total = 0;
            let itemTotal = document.querySelector('.total');

            factura.forEach((item) => {
                let precio = Number(item.precio.replace("L.", ""));
                let cant = Number(item.cantidad)
                total = total + precio * cant;

            });
            itemTotal.innerHTML = `<h5>Total: L. ${total.toFixed(2)}</h5> `;
        }

        function QuitarItemCarrito(e) {
            const botonEliminar = e.target;
            const tr = botonEliminar.closest(".itemFac");
            const titulo = tr.querySelector('.titulo').textContent;

            for (let i = 0; i < factura.length; i++) {
                if (factura[i].titulo.trim() === titulo.trim()) {
                    factura.splice(i, 1);
                }
            }
            tr.remove();
            total()
        }

        function cambCant(e) {
            const cambio = e.target;
            const tr = cambio.closest(".itemFac");
            const titulo = tr.querySelector('.titulo').textContent;
            factura.forEach((item) => {
                if (item.titulo.trim() === titulo) {
                    cambio.value < 1 ? (cambio.value = 1) : cambio.value;
                    item.cantidad = cambio.value;
                    total()
                }
            });

        }

        function funcionNumeros(evt) {
            var code = (evt.which) ? evt.which : evt.keyCode;
            if (code == 46) {
                return true;
            } else if (code >= 48 && code <= 57) {
                return true;
            } else {
                return false;
            }
        }

        function funcionObtenerTel(){
            var select = document.getElementById("cliente_id");
            var valor = select.value;

             
        }

    </script>
@endsection



