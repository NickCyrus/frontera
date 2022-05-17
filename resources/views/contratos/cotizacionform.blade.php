<div class="container py-3">
    <form action="{{route('contratos.cotizaciones.save' , ['id'=>$contrato->id] )}}" method="POST"  autocomplete="off">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />


        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Descripción</label>
          <div class="col-sm-9">
            <input type="text" name="description" value="{{$module->description}}" class="form-control" placeholder="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Lider FEC</label>
          <div class="col-sm-9">
            <input type="text" name="lider_fec" value="{{$module->lider_fec}}" class="form-control" placeholder="" required>
          </div>
        </div>

        @if ( $all ??  false)

            <div class="row mb-3 item-hiden" @if ($module->state != 3 ) style="display:none" @endif >
            <label class="col-sm-3 col-form-label" for="basic-default-name">CC - Solutec</label>
            <div class="col-sm-9">
                <input type="text" name="cc_solutec" id="cc_solutec" value="{{$module->cc_solutec}}" class="form-control" placeholder="" @if ($module->state == 3 ) required @endif  >
            </div>
            </div>
            <div class="row mb-3 item-hiden" @if ($module->state != 3 ) style="display:none" @endif >
                <label class="col-sm-3 col-form-label" for="basic-default-name">N° PR</label>
                <div class="col-sm-9">
                    <input type="text" name="n_pr" id="n_pr" value="{{$module->n_pr}}" class="form-control" placeholder="" @if ($module->state == 3 ) required @endif>
                </div>
            </div>
            <div class="row mb-3 item-hiden" @if ($module->state != 3 ) style="display:none" @endif>
                <label class="col-sm-3 col-form-label" for="basic-default-name">N° pedido</label>
                <div class="col-sm-9">
                    <input type="text" name="n_pedido" id="n_pedido" value="{{$module->n_pedido}}" class="form-control" placeholder="" @if ($module->state == 3 ) required @endif>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="basic-default-name">Estado</label>
                <div class="col-sm-9">

                    @php
                        if ($module->state == 1) $where = "WHERE id=2";
                        if ($module->state == 2) $where = "WHERE id IN ( 3 , 4 , 5 )";
                        if ($module->state > 2) $where = "WHERE id IN ( 3 , 4 , 5 )";
                    @endphp

                    @include('component.select',
                        ['name'=>'state',
                        'value'=>$module->state ,
                        'where'=>$where,
                        'tbl'=>'quotes_states' ,
                        'label'=>'name',
                        'onchange'=>'validState(this.value)',
                        'required'=>'required'])


                </div>
            </div>

        @endif


        <div class="row text-center">
            <div class="col-sm-12">
                <button type="button" onclick="fn.closeModal()" class="btn btn-danger"> <i class='bx bx-window-close' ></i> Cancelar</button>
                @if ($module->state != 3 ) <button type="submit" class="btn btn-secondary"> <i class='bx bxs-save' ></i> Guardar</button> @endif

            </div>
        </div>
      </form>
</div>

<script>
    validState = function(valor){
        if (valor == 3){
            $('.item-hiden').show();
            required($('#cc_solutec , #n_pr , #n_pedido'));
        }else{
            $('.item-hiden').hide();
            norequired($('#cc_solutec , #n_pr , #n_pedido'));
        }
    }
</script>
