@extends('plantillas.register1')
@section('title', 'Registro de animales')

@section('encabezado', 'Registro de compra de animales')

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

    <form action="{{ route('compraAnimal.store') }}" id="formulario" name="formulario" method="POST">
        @csrf

        <div class="modal-body" style="font-family: 'Nunito', sans-serif; font-size: small; padding-top: 10px">
            <div class="page-content container-fluid">
                <div class="page-header text-blue-d2">
                    <h5 class="text-secondary-d1">Datos de la compra:</h5>
                </div>

                <div class="container px-0">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <!-- Nombre del proveedor -->
                                <div class="col-sm-3 mb-3 mb-sm-0">

                                        <label for="proveedor" class="text-secondary-d1"><strong>Nombre del proveedor:</strong></label>
                                        <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                                    name="proveedor" type="text" maxlength="45"
                                    placeholder="Ingrese el proveedor" value="{{ old('proveedor') }}" />
                                    @error('proveedor')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <!-- fecha -->
                                <div class="col-sm-3 mb-3 mb-sm-0">

                                        <label for="nacimiento" class="text-secondary-d1"><strong>Fecha de nacimiento:</strong></label>
                                        <input class="form-control @error('nacimiento') is-invalid @enderror" id="nacimiento"
                                    name="nacimiento" type="date" min="{{ date("Y-m-d",strtotime(now()."- 120 months"));}}" max="{{ date("Y-m-d",strtotime(now()."- 1 month")); }}"
                                    value="{{old('nacimiento')}}" />
                                    @error('nacimiento')
                                        <span class="invalid-feedback" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                </div>

                                <div class="col-sm-3 mb-3 mb-sm-0">

                                    <label for="fecha" class="text-secondary-d1"><strong>Fecha de compra:</strong></label>
                                    <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                                name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
                                value="{{old('fecha')}}" />
                                @error('fecha')
                                    <span class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                            </div>

                                <div class="col-sm-4 mb-2 mb-sm-0">
                                    <label for="descripcion" class="text-secondary-d1"><strong>Descripción de la compra:</strong></label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                                name="descripcion" type="text" style="height:100px" placeholder="Ingrese la descripción de la compra"
                                maxlength="150">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>

                        <div class="page-header text-blue-d2">
                            <h5 class="text-secondary-d1">Detalles de la compra:</h5>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="input-group">
                                        <input type="text" name="buscar_animal" id="buscar_animal"
                                               class="form-control border-1 small" placeholder="Buscar por tipo de animales"
                                               aria-label="Search" aria-describedby="basic-addon2" style=""  onkeyup="filtrar_animales()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-5 mb-3 mb-sm-0">
                                    <!-- Catalogo de Productos -->
                                    <div class="table-responsive" style=" height: 500px; overflow:scroll;  float:left; ">
                                        <section class="NovidadesSection">
                                            <div class="animal" id="animal"
                                                 style="display: grid; grid-template-columns: 140px 140px 140px;">
                                                @foreach($animales as $pro)
                                                    <div class="agregarLista" id=""
                                                         style="display:block;  height: 100px; width: 140px; padding: 3px ">
                                                        <div class="card h-100 btn" data-id="{{$pro->id}}">
                                                            <div class="" style="text-align:center;">
                                                                <div class="text-center">
                                                                    <!-- Tipo del animal -->
                                                                    <p class="tipo" id="tipo">
                                                                        <strong style="font-size: 12px">{{$pro->tipo}}</strong>
                                                                    </p>
                                                                    <!-- raza del animal -->
                                                                    <div class="raza">
                                                                        <span id="ra" class="pre text-muted text-decoration-line">
                                                                            <strong style="font-size: 15px">{{$pro->raza}}</strong>
                                                                        </span>
                                                                    </div>
                                                                     <!-- raza del animal -->
                                                                     <div class="proposito">
                                                                        <span id="prop" class="pre text-muted text-decoration-line">
                                                                            <strong style="font-size: 15px">{{$pro->proposito}}</strong>
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

                                <div class="col-sm-7 mb-3 mb-sm-0" style="padding: 2px; height: 500px; ">
                                    <div class="container-fluid" style="overflow:scroll; height: 430px;" >
                                        <table class="table">
                                            <thead class="bg-none bgc-default-tp1">
                                            <tr class="text-white">
                                                <th colspan="3">Tipo</th>
                                                <th width="140">Cantidad</th>
                                                <th width="140">Precio Compra</th>
                                                <th width="140">Precio Venta</th>
                                                <th width="140">Total</th>
                                                <th width="140">Eliminar</th>
                                            </tr>
                                            </thead>

                                            <tbody id="tbody-animal" class="tbody-animal">

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

                                                <a href="#" onclick="guardar()"
                                                   class="btn btn-primary btn-bold px-4 float-right mt-3 mt-lg-0 mr-2">Guardar</a>

                                                <a href="{{route('index')}}"
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
        let animal = @json($animales);
        let busqueda = [];
        function filtrar_animales() {
            let textobusqueda = document.getElementById("buscar_animal").value;
            busqueda = [];
            animal.forEach(function(a){
                let texto = a.tipo;
                if(texto.toLowerCase().includes(textobusqueda.toLowerCase())){
                    busqueda.push(a);
                }
            });

            let contenedor = document.getElementById('animal');
            contenedor.innerHTML = '';

            busqueda.forEach(function(params) {

                let componente =  '<div class="agregarLista" id="" \
                                        style="display:block;  height: 100px; width: 140px; padding: 3px">\
                                        <div class="card h-100 btn" data-id="'+params.id+'">\
                                            <div class="" style="text-align:center ;">\
                                                <div class="text-center">\
                                                    <!-- Nombre del animal -->\
                                                    <p class="tipo" id="tipo">\
                                                        <strong style="font-size: 12px">'+params.tipo+'</strong>\
                                                    </p>\
                                                    <!-- Raza -->\
                                                    <div class="raza">\
                                                        <span id="ra" class="pre text-muted text-decoration-line">\
                                                            <strong style="font-size: 15px">'+params.raza+'</strong>\
                                                        </span>\
                                                    </div>\
                                                    <!-- Propósito -->\
                                                    <div class="proposito">\
                                                        <span id="prop" class="pre text-muted text-decoration-line">\
                                                            <strong style="font-size: 15px">'+params.proposito+'</strong>\
                                                        </span>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                contenedor.innerHTML+=componente;

                const Clickbutton = document.querySelectorAll('.btn');

                Clickbutton.forEach(btn => {
                    btn.addEventListener('click', addLista);
                });
            });



        }
        function buscar() {
            var impu_buscar = document.getElementById("buscar_animal");
            window.location.href = "{{ route('compraAnimal.buscarpro') }}?buscar_animal=" + impu_buscar.value;
        }



        const Clickbutton = document.querySelectorAll('.btn');
        const tbody = document.querySelector('.tbody-animal');
        let lista = [];

        function guardar() {
            var formul = document.getElementById("formulario");

            formul.submit();

            tbody.innerHTML = '';
        }

        Clickbutton.forEach(btn => {

            btn.addEventListener('click', addLista);
        });

        function addLista(e) {
            const boton = e.target;
            const item = boton.closest('.agregarLista');

            const itemTitulo = item.querySelector('.tipo').textContent;
            const itemId = item.querySelector(".btn").getAttribute('data-id');
            const itemCantidad = 1;
            const itemPrecioC = 1;
            const itemPrecioV = 1;

            addItemLista(itemId, itemTitulo, itemCantidad, itemPrecioC, itemPrecioV );
        }

        function addItemLista(itemId, itemTitulo, itemCantidad, itemPrecioC, itemPrecioV) {

           const elemento =  tbody.getElementsByClassName('tipo');
           for (let i = 0; i < elemento.length; i++) {
            if (elemento[i].innerText.trim() === itemTitulo.trim()) {
                    let canti = elemento[i].parentElement.parentElement.parentElement.
                    querySelector('.cant');
                    total();
                    return;
                }

           }

           var i = 0;
           const filaLista =  document.createElement('tr');
           filaLista.classList.add('filas');
           const Content = `

            <td colspan="3" class="tipo" name="tipo">${itemTitulo}</td>
            <input name="idA" id="idA" class="idA" type="text" data-id="${itemId}" value="${itemId}" readonly style="display:none">
            <td>
                <input class="form-control cant @error('cantidad') is-invalid @enderror" id="cantidad"
                    name="cantidad" type="text" maxlength="3"
                    placeholder="Cantidad" value="${itemCantidad}"
                />
                @error('cantidad')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td>
            <td>
                <input class="form-control price @error('precioCompra') is-invalid @enderror" id="precioCompra"
                name="precioCompra" type="text" maxlength="5"
                placeholder="precio" value="${itemPrecioC}" />
                @error('precioCompra')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td>
            <td>
                <input class="form-control priceV @error('precioVenta') is-invalid @enderror" id="precioVenta"
                name="precioVenta" type="text" maxlength="5"
                placeholder="precio" value="${itemPrecioV}" />
                @error('precioVenta')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </td>
            <td  width="140" class="subTotal"></td>

            <td  width="140">
                <a class="delete btn btn-danger">X</a>
            </td>
                <input name="detalle-` + i + `" type="text" value="${itemId} ${itemCantidad} ${itemPrecioC} ${itemPrecioV}" readonly style="display:none">

            `;
            filaLista.innerHTML = Content;
            tbody.append(filaLista);

            filaLista.querySelector('.delete').addEventListener('click', quitarItemCarrito);
            filaLista.querySelector('.cant').addEventListener('change', cambCantidad);
            filaLista.querySelector('.price').addEventListener('change', cambPrecioC);
            filaLista.querySelector('.priceV').addEventListener('change', cambPrecioV);

            i++;
            document.formulario.tuplas.value = lista.length;
        }

        function total() {
            let total = 0;
            const itemTotal = document.querySelector('.total');
            const lista = document.querySelectorAll('.filas');

            lista.forEach((item) => {
                const elemento = item.querySelector('.price');
                const precio = Number(elemento.value);
                const cant = item.querySelector('.cant');
                const cantidad = Number(cant.value);

                subTotal = precio * cantidad;

                total = total + precio * cantidad;
            });
            itemTotal.innerHTML = `<h5>Total: L. ${total.toFixed(2)}</h5> `;
        }

        function quitarItemCarrito(e) {
            const botonEliminar = e.target;
            const tr = botonEliminar.closest(".filas");
            const id = tr.querySelector('.idA').getAttribute('data-id');

            for (let i = 0; i < lista.length; i++) {
                if (lista[i].id.trim() === id.trim()) {
                    lista.splice(i, 1);
                }
            }
            tr.remove();
            total()
        }

        function cambCantidad(e) {
            const cambio = e.target;
            cambio.value <= 0 ? (cambio.value = 1) : null;
            total();
        }

        function cambPrecioC(e){
            const cambio = e.target;
            cambio.value <= 0 ? (cambio.value = 1) : null;
            total();
        }

        function cambPrecioV(e){
            const cambio = e.target;
            cambio.value <= 0 ? (cambio.value = 1) : null;
            total();
        }



    </script>
@endsection
