<div class="container py-3">
    <form action="{{route('materiales.save')}}" method="POST"  autocomplete="off">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Código</label>
          <div class="col-sm-9">
            <input type="text" name="code" value="{{$module->code}}" class="form-control" placeholder="" required>
          </div>
        </div>


        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Descripción</label>
          <div class="col-sm-9">
            <input type="text" name="description" value="{{$module->description}}" class="form-control" placeholder="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Unidad de Medida</label>
          <div class="col-sm-9">
            
            @include('component.select', 
            ['name'=>'measure_id', 
             'value'=>$module->measure_id , 
             'tbl'=>'measures' , 
             'label'=>'description',
             'required'=>'required'])

             
          </div>
      </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Valor</label>
          <div class="col-sm-9">
            <input type="text" name="value" value="{{$module->value}}" class="form-control on" placeholder="" required  >
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