@extends('plantillas.index')

@section('title', 'Restaurante')

@section('content')

<div class="container-fluid px-4">
Restaurante
    <h1 class="mt-4">Categorías del Restaurante</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <div class="row align-items-center justify-content-center">
        <div class="col-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">Inventario</div>
                <img src="assets/img/crisol.png" alt="villa Crisol" width="385px" height="300px">
                <div class="card-body">*******<br>*****</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">MOSTRAR</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">Compras</div>
                <img src="assets/img/crisol.png" alt="villa Crisol"  width="385px" height="300px">
                <div class="card-body">En este apartado podrá registrar, ver y editar los datos de las compras realizadas</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('compras.index')}}">MOSTRAR</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
