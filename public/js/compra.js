const carro = new Carrito();
const carrito = document.getElementById('carrito');
const products = document.getElementById('producto');
const listaProductos = document.querySelector('#lista-compra tbody');

cargarEventos();

function cargarEventos() {
  products.addEventListener('click', (e)=>{carro.comprarProducto(e)});

  carrito.addEventListener('click', (e)=>{carro.eliminarProducto(e)});

  document.addEventListener('DOMContentLoaded', carro.leeLS());

  carro.calcularTotal();

  carrito.addEventListener('change', (e) => { carro.cambCantidad(e) });
  carrito.addEventListener('change', (e) => { carro.cambPrecio(e) });
  carrito.addEventListener('change', (e) => { carro.cambImp(e) });
}


