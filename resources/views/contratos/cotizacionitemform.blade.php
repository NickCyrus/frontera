<div class="container py-3">
    <form action="{{route('contratos.cotizaciones.item.save' , ['id'=>$contrato->id , 'item'=>$cotizacion->id, 'iditem'=>$item->id] )}}" method="POST"  autocomplete="off">
        @csrf
        
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Contrato</label>
            <div class="col-sm-9">
                 <input readonly value="{{$contrato->name}}" class="form-control" />
            </div>
          </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Cotización</label>
          <div class="col-sm-9">
               <input readonly value="{{$cotizacion->description}}" class="form-control" />
          </div>
        </div>

         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">AETOS</label>
            <div class="col-sm-9">
                 <input readonly value="{{$item->aetos}}" class="form-control" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">ITEM</label>
            <div class="col-sm-9">
                 <textarea readonly class="form-control">{{$item->description}}</textarea> 
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">VALOR</label>
            <div class="col-sm-9">
                <input readonly value="@currency($item->value)" class="form-control" /> 
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Cantidad</label>
            <div class="col-sm-9">
                <input name="item_quantity" value="1" class="form-control on" /> 
            </div>
          </div>

         
        
        <div class="row text-center">
            <div class="col-sm-12">
                <button type="button" onclick="fn.closeModal()" class="btn btn-danger"> <i class='bx bx-window-close' ></i> Cancelar</button>
                <button type="submit" class="btn btn-secondary"> <i class='bx bxs-save' ></i> Guardar</button> 
            </div>
        </div>
      </form> 
</div>
<script>
    fn.applyPlugins()
</script>
 