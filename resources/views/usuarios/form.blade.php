<div class="container py-3">
    <form action="{{route('usuarios.save')}}" method="POST"  autocomplete="off">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Nombre</label>
          <div class="col-sm-9">
            <input type="text" name="name" value="{{$module->name}}" class="form-control" placeholder="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Email</label>
          <div class="col-sm-9">
            <input type="email" name="email" value="{{$module->email}}" class="form-control" placeholder="" required>
          </div>
        </div>
 
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Perfil</label>
            <div class="col-sm-9">
              
              @include('component.select', 
              ['name'=>'profid', 
               'value'=>$module->profid , 
               'tbl'=>'profiles' , 
               'label'=>'profname',
               'required'=>'required'])

               
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Contraseña</label>
            <div class="col-sm-9">
              <input type="password" name="password" value="{{$module->valuemonth}}" class="form-control" placeholder="" @if(!$module->id) required @endif >
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