<div class="container py-3">
    <form action="{{route('contratos.save')}}" method="POST"  autocomplete="off">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Fecha inicio</label>
          <div class="col-sm-9">
            <input type="date" name="initialdate" value="{{$module->initialdate}}" class="form-control" placeholder="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Nombre Contratante</label>
          <div class="col-sm-9">
            <input type="text" name="contractor" value="{{$module->contractor}}" class="form-control" placeholder="" required>
          </div>
        </div>


        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Nombre del Contrato</label>
          <div class="col-sm-9">
            <input type="text" name="name" value="{{$module->name}}" class="form-control" placeholder="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Numero del Contrato</label>
          <div class="col-sm-9">
            <input type="text" name="number" value="{{$module->number}}" class="form-control" placeholder="" required>
          </div>
        </div>
       
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Valor Contrato</label>
          <div class="col-sm-9">
            <input type="text" name="price" value="{{$module->price}}" class="form-control on" placeholder="" required  >
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Plazo de Ejecución</label>
          <div class="col-sm-9">
            <input type="text" name="term" value="{{$module->term}}" class="form-control on" placeholder="180 días" required>
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