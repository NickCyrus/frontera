<div class="container py-3">
    <form action="{{route('modules.save')}}" method="POST">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Nombre módulo</label>
          <div class="col-sm-9">
            <input type="text" name="nameapp" value="{{$module->nameapp}}" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Icono módulo</label>
            <div class="col-sm-9">
              <input type="text" name="iconapp" value="{{$module->iconapp}}" class="form-control" placeholder="" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Slug módulo</label>
            <div class="col-sm-9">
              <input type="text" name="urlapp" value="{{$module->urlapp}}" class="form-control" placeholder="" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Orden módulo</label>
            <div class="col-sm-9">
              <input type="number" min="1" name="orderapp" value="{{$module->orderapp}}" class="form-control" placeholder="">
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