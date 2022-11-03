@extends('plantillas.index')
@section('title', 'Registro de compras')
@section('content')

    <div class="card shadow mb-4 " >
        <div class="card-header py-2" style="background: #0d6efd">
            <div style="float: left">
                <h2 class="m-0 font-bold" style="color: white">Ristrar compras</h2>
            </div>

        </div>

        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row" id="tblaBody">
                <div class="col-lg-5 d-lg-block">
                    <div class="p-3">
                    <form method="post" action="{{route('regcompra.create')}}">
    @csrf
                    <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numfactura">Número de factura</label>
                            <input class="form-control @error('numfactura') is-invalid @enderror" id="numfactura"
                     name="numfactura" type="num" maxlength="5"
                    placeholder="" value="{{ old('numfactura') }}" />
                    @error('numfactura')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="fecha">Fecha de registro de compra</label>
                <input class="form-control @error('fecha') is-invalid @enderror" id="fecha"
      name="fecha" type="date" min="{{ date("Y-m-d",strtotime(now()."- 1 month"));}}" max="{{ now()->toDateString('Y-m-d') }}"
       value="{{old('fecha')}}" />
                    @error('fecha')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                            </div>
                        </div>
                  
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="proveedor">Nombre del proveedor</label>
                            <input class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                     name="proveedor" type="text" maxlength="45"
                    placeholder="" value="{{ old('proveedor') }}" />
                    @error('proveedor')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="total">Ingrese el total de la compra</label>
                <input class="form-control @error('total') is-invalid @enderror" id="total"
      name="total" type="num" value="{{old('total')}}" maxlength="6"/>
                    @error('total')
                        <small class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="total">Ingrese el impuesto de la compra</label>
                <input class="form-control @error('impuesto') is-invalid @enderror" id="impuesto"
      name="impuesto" type="num" value="{{old('impuesto')}}" maxlength="5"/>
                    @error('impuesto')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="categoria">Seleccione una categoria </label>
                <select  class="form-control @error('categoria') is-invalid @enderror" name="categoria">
                <option value="">--seleccione una categoria--</option>
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
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="descripción">Descripción de la compra</label>
                            <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción"
                     name="descripción" type="text" style="height:145px" maxlength="150">{{ old('descripción') }}</textarea>
                    @error('descripción')
                    <small class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                        </div>
                        <div class="form-group row" style="margin-top: 15px">
                            <div class="col-sm-5 mb-3 mb-sm-0">
                            <button class="btn btn-primary mt-10" type="submit">Guardar</button>
                            </div>
                            <div class="col-sm-5">
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Cancelar
                    </button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cancelar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            ¿Está seguro de cancelar el formulario?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="" class="btn btn-primary">Si</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                            <div class="col-sm-2">
                                <a style="display: inline-block; background: #b02a37; color: white; border: 2px solid #ffffff;border-radius: 4px; font-size: large"
                                data-toggle="modal" data-target="#modal_agregar_rgcompra" class="btn btn-google btn-user btn-block">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="table-responsive" id="tblaBody">
                        <table class="table table" id="dataTable">
                            <thead class="card-header py-3" style="background: #1a202c; color: white">
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th colspan="3">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <th scope="row"> </th>
                            <td scope="row"> </td>
                            <td scope="row"> </td>
                            <td><a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_rcompra">
                                            <i class="fa fa-edit" style="color: white"></i></a></td>
                                            <td><a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_rcompra">
                                            <i class="fa fa-edit" style="color: white"></i></a></td>
                                    <tr>
                                            <td colspan="8">No hay registro de compras</td>
                                    </tr>
                
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>


<div class="modal fade" id="modal_agregar_rcompra" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
               <button type="button" class="btn-close" data-dismiss="modal"
                       aria-label="Close"></button>
           </div>
 
   </div>
</div>
@endsection

@push('scripsss')
<script>
            $(document).ready(function() {

                $('#tblaBody').css('height', (screen.height - 450));

                new TomSelect("#productos_id",{
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            });
</script>
@endpush
