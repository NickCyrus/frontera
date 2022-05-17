
<div class="col-md-12 mb-3">
    <a href="{{ $route ?? route('contratos') }}" class="btn btn-back"><i class='bx bx-left-arrow-alt' ></i>Regresar a {{ $backText ?? 'contratos' }} </a>
</div>


<div class="card mb-3 bg-success">
    <div class="row card-body color-black">
            <h2 class="color-white">Información del contrato </h2>
            <div class="col-md-3">
                    <label >Nombre Contrato</label>
                    <h3 class="color-white">{{$contrato->name}}</h3>
            </div>
            <div class="col-md-3">
                <label>Contratante</label>
                <h3 class="color-white">{{$contrato->contractor}}</h3>
            </div>
            <div class="col-md-3">
                <label>Plazo (días)</label>
                <h3 class="color-white">{{$contrato->term}}</h3>
            </div>           
    </div>
</div>