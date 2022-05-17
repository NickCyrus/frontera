<div class="container py-3">
    <form action="{{route('perfiles.save')}}" method="POST">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />
        <div class="col-12 mb-4 fv-plugins-icon-container">
          <label class="form-label" for="modalRoleName">Perfil</label>
          <input type="text" id="modalRoleName" name="profname" value="{{$module->profname}}" class="form-control" placeholder="Nombre del perfil" tabindex="-1" required>
        <div class="fv-plugins-message-container invalid-feedback"></div></div>
        <div class="col-12">
          <h4>Permisos</h4>
          <!-- Permission table -->
          <div class="table-responsive">
            <table class="table table-flush-spacing">
              <tbody>
                <tr>
                  <td class="text-nowrap fw-semibold">Se permite <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i></td>
                  <td> </td>
                </tr>

                @forelse(\App\Models\modulesapp::orderby('orderapp')->get() as $mod)

                    <tr>
                      <td class="text-nowrap fw-semibold">{{$mod->nameapp}}</td>
                      <td>
                        <div class="d-flex">
                          <div class="form-check me-3 me-lg-4">
                            <input class="form-check-input" type="checkbox" @if( \App\Models\profpermission::getPermiso($module->id , $mod->id , 'aview')) @checked(true) @endif name="module[{{$mod->id}}][aview]" value="1" id="userManagementRead">
                            <label class="form-check-label" >
                              Ver
                            </label>
                          </div>
                          <div class="form-check me-3 me-lg-4">
                            <input class="form-check-input" type="checkbox" @if( \App\Models\profpermission::getPermiso($module->id , $mod->id , 'anew')) @checked(true) @endif name="module[{{$mod->id}}][anew]"  value="1"  id="userManagementRead">
                            <label class="form-check-label" >
                              Crear
                            </label>
                          </div>
                          <div class="form-check me-3 me-lg-4">
                            <input class="form-check-input" type="checkbox" @if( \App\Models\profpermission::getPermiso($module->id , $mod->id , 'aedit')) @checked(true) @endif name="module[{{$mod->id}}][aedit]"  value="1"  id="userManagementWrite">
                            <label class="form-check-label" >
                              Editar
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" @if( \App\Models\profpermission::getPermiso($module->id , $mod->id , 'adelete')) @checked(true) @endif name="module[{{$mod->id}}][adelete]"  value="1"  id="userManagementCreate">
                            <label class="form-check-label" >
                              Eliminar
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                 @empty
                    <tr>
                        <td colspan="2">No existen módulos dispobible</td>
                    </tr>
                 @endforelse
              </tbody>
            </table>
          </div>
          <!-- Permission table -->
        </div>
        <div class="col-12 text-center">
          <button type="button" onclick="fn.closeModal()" class="btn btn-danger"> <i class='bx bx-window-close' ></i> Cancelar</button>
          <button type="submit" class="btn btn-secondary"> <i class='bx bxs-save' ></i> Guardar</button>
        </div>
      <div></div>
      </form> 
</div>