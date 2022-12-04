class Carrito {

    //Añadir producto al carrito
    comprarProducto(e){
        e.preventDefault();
        //Delegado para agregar al carrito
        if(e.target.classList.contains('btn-agregar')){
            const producto = e.target.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            this.leerDatosProducto(producto);
        }
    }

    //Leer datos del producto
    leerDatosProducto(producto){
        const infoProducto = {
            titulo: producto.querySelector('h4').textContent,
            cantidad: 1,
            precio: 0,
            impuesto: 0,
            id: producto.querySelector('a').getAttribute('data-id'),

        }
        let productosLS;
        productosLS = this.obtenerProductoLS();
        productosLS.forEach(function(productoLS) {
            if (productoLS.id === infoProducto.id) {
                productosLS = productoLS.id;
            }
        });
        if (productosLS === infoProducto.id) {
            console.log('producto agregado')
        }else{
            this.insertarCarrito(infoProducto);
            this.calcularTotal();
        }

    }

    //muestra producto seleccionado en carrito
    insertarCarrito(producto){
        var i = 0;
        let productosL;
        productosL = this.obtenerProductoLS();

        const row = document.createElement('tr');
        row.classList.add('itemFac');
        row.innerHTML = `
            <td>${producto.titulo}</td>
            <td width="120px">
                <input class="producto_id" id="producto_id" name="producto_id" value="${producto.id}" hidden/>
                <input class="form-control cantidad" id="cantidad" min=1
                name="cantidad" type="number" maxlength="3"
                placeholder="Cantidad" value="${producto.cantidad}"/>
            </td>
            <td width="120px">
                <input class="form-control precio" id="precio" min=1
                name="precio" type="number" maxlength="5"
                placeholder="precio" value="${producto.precio}" />
            </td>
            <td width="130px">
                <select class="form-control imp" id="imp"
                    name="imp" value="{{old('imp')}}">
                    <option value="0.00" @if(old('imp') == "0.00") {{ 'selected' }} @endif>Excento</option>
                    <option value="0.15" @if(old('imp') == "0.15") {{ 'selected' }} @endif>15%</option>
                    <option value="0.18" @if(old('imp') == "0.18") {{ 'selected' }} @endif>18%</option>
                </select>
            </td>
            <td width="120px">L  ${(producto.cantidad * producto.precio + (producto.precio * producto.cantidad * producto.impuesto)).toFixed(2)} </td>
            <td>
                <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}" style="font-size: 25px;" ></a>
                <input name="detalle-` + i + `" type="text" value="${producto.id} " readonly style="display:none">
            </td>
        `;
        listaProductos.appendChild(row);
        this.guardarProductosLS(producto);

        document.formulario_compras.tuplas.value = productosL.length;
        i++;
    }

    eliminarProducto(e){
        e.preventDefault();
        let producto, productoID;

        if (e.target.classList.contains('borrar-producto')) {
            e.target.parentElement.parentElement.remove();
            producto = e.target.parentElement.parentElement;
            productoID = producto.querySelector('.borrar-producto').getAttribute('data-id');
        }
        this.eliminarProductoLS(productoID);
        this.calcularTotal();
    }

    guardarProductosLS(producto){
        let productos;
        productos = this.obtenerProductoLS();
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    obtenerProductoLS(){
        let productoLS;

        if(localStorage.getItem('productos') === null){
            productoLS = [];
        } else{
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }

    eliminarProductoLS(productoID){
        let productosLS;
        productosLS = this.obtenerProductoLS();
        for (let i = 0; i < productosLS.length; i++) {
            if (productosLS[i].id === productoID) {
                productosLS.splice(i, 1);
            }
        }
        localStorage.setItem('productos', JSON.stringify(productosLS));
    }

    leeLS(){
        let productosLS;
        productosLS = this.obtenerProductoLS();
        productosLS.forEach(function(producto){
            const row = document.createElement('tr');
            row.classList.add('itemFac');
        row.innerHTML = `
            <td class="titulo">${producto.titulo}</td>
            <td width="120px">
                <input class="form-control cantidad" id="cantidad" min=1
                name="cantidad" type="number" maxlength="3"
                placeholder="Cantidad" value="${producto.cantidad}"/>
            </td>
            <td width="120px">
                <input class="form-control precio" id="precioCompra"
                name="precioCompra" type="number" maxlength="5" min=1
                placeholder="precio" value="${producto.precio}" />
            </td>
            <td width="130px">
                <select class="form-control imp" id="imp"
                    name="imp" value="{{old('imp')}}" >
                    <option value="0.00" @if(old('imp') == "0.00") {{ 'selected' }} @endif>Excento</option>
                    <option value="0.15" @if(old('imp') == "0.15") {{ 'selected' }} @endif>15%</option>
                    <option value="0.18" @if(old('imp') == "0.18") {{ 'selected' }} @endif>18%</option>
                </select>
            </td>
            <td width="120px">L  ${(producto.cantidad * producto.precio + (producto.precio * producto.cantidad * producto.impuesto)).toFixed(2)} </td>
            <td>
                <a href="#" class="borrar-producto fas fa-times-circle" style="font-size: 25px;" data-id="${producto.id}"></a>
            </td>
        `;
        listaProductos.appendChild(row);
        document.formulario_compras.tuplas.value = productosLS.length;
        });
    }

    calcularTotal(){
        let productoLS;
        let total = 0, subTotal = 0, imp = 0;
        const itemTotal = document.querySelector('.total');

        productoLS = this.obtenerProductoLS();

        for (let i = 0; i < productoLS.length; i++) {
            let impuesto = Number(productoLS[i].precio * productoLS[i].cantidad * productoLS[i].impuesto);
            let elemento = Number(productoLS[i].precio * productoLS[i].cantidad);
            subTotal = subTotal + elemento;
            imp = impuesto + imp;
        }
        total = parseFloat(subTotal + imp).toFixed(2);
        itemTotal.innerHTML = `
        <h6>Sub-Total: L. ${subTotal.toFixed(2)}</h6> <br>
        <h6>Imp: L. ${imp.toFixed(2)}</h6> <br>
        <h6>Total: L. ${total}</h6> `;
    }

    cambCantidad(e) {
        e.preventDefault();
        let id, cantidad, producto, productosLS;
        if (e.target.classList.contains('cantidad')) {
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('.borrar-producto').getAttribute('data-id');
            cantidad = producto.querySelector('.cantidad');
            productosLS = this.obtenerProductoLS();
            productosLS.forEach(function (productoLS) {
                if (productoLS.id === id) {
                   cantidad.value <= 0 ? (cantidad.value = 1) : null;
                    productoLS.cantidad = cantidad.value;
                }
            });
            localStorage.setItem('productos', JSON.stringify(productosLS));

        }
        else {
            console.log("click afuera");
        }
    }

    cambPrecio(e) {
        e.preventDefault();
        let id, precio, producto, productosLS;
        if (e.target.classList.contains('precio')) {
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('.borrar-producto').getAttribute('data-id');
            precio = producto.querySelector('.precio');
            productosLS = this.obtenerProductoLS();
            productosLS.forEach(function (productoLS) {
                if (productoLS.id === id) {
                    precio.value <= -1 ? (precio.value = 0) : null;
                    productoLS.precio = precio.value;
                }
            });
            localStorage.setItem('productos', JSON.stringify(productosLS));

        }
        else {
            console.log("click afuera");
        }
    }

    cambImp(e) {
        e.preventDefault();
        let id, impuesto, producto, productosLS;
        if (e.target.classList.contains('imp')) {
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('.borrar-producto').getAttribute('data-id');
            impuesto = producto.querySelector('.imp').value;
            productosLS = this.obtenerProductoLS();
            productosLS.forEach(function (productoLS) {
                if (productoLS.id === id) {
                    productoLS.impuesto = impuesto;
                }
            });
            localStorage.setItem('productos', JSON.stringify(productosLS));

        }
        else {
            console.log("click afuera");
        }
    }

}
