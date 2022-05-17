@php
    $slug = 'contratos.cotizaciones';
    $slugURL = "contratos/{$contrato->id}/cotizaciones";
    use Carbon\Carbon;  
@endphp
@extends('app')
@section('content')
    @include('contratos.part.cabecera')
<div class="card">
    <div class="card-header">
        @if ($permission->anew)  
            <button onclick="addItem()" class="btn btn-success pull-right  event-plus" >
                <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar cotización
            </button>
        @endif
        <h3>Cotizaciones</h3>
    </div>
    <div class="card-body">
        <div class="row">
                

                <div class="col-md-3 col-md-3-20">
                  <span class="d-block mb-1">PPTO Creados</span>
                  <h3 class="card-title text-nowrap mb-2">@currency($contrato->sumCreados())</h3>
                </div>
                <div class="col-md-3 col-md-3-20">
                  <span class="d-block mb-1">PPTO Entregados</span>
                  <h3 class="card-title text-nowrap mb-2">@currency($contrato->sumPendientes())</h3>
                </div>
                <div class="col-md-3 col-md-3-20">
                  <span class="d-block mb-1">PPTO Aprobado</span>
                  <h3 class="card-title text-nowrap mb-2">@currency($contrato->sumAprobado())</h3>
                </div>
                <div class="col-md-3 col-md-3-20">
                    <span class="d-block mb-1">PPTO Suspendidos</span>
                    <h3 class="card-title text-nowrap mb-2">@currency($contrato->sumSuspendido())</h3>
                </div>
                <div class="col-md-3 col-md-3-20">
                    <span class="d-block mb-1">PPTO No Aprobados</span>
                    <h3 class="card-title text-nowrap mb-2">@currency($contrato->sumSinAprobar())</h3>
                </div>
                
        </div>
 
        <div class="mt-4">
              <table class="table table-striped dn-table">
                <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Descripción</th>
                    <th>CC - Solutec</th>
                    <th>N° PR</th>
                    <th>N° PEDIDO</th>
                    <th>Lider FEC</th>
                    <th>VR. PPTO Suspendidos</th>
                    <th>VR. PPTO Sin aprobar</th>
                    <th>VR. PPTO Aprobado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  
                    @forelse($contrato->cotizaciones()  as $modulo)
                  <tr>
                    <td>{{$modulo->id}}</td>
                    <td>{{$modulo->description}}</td>
                    <td>{{$modulo->cc_solutec}}</td>
                    <td>{{$modulo->n_pr}}</td>
                    <td>{{$modulo->n_pedido}}</td>
                    <td>{{$modulo->lider_fec}}</td>
                    <td>@currency($modulo->vr_suspendidos)</td>
                    <td>@currency($modulo->vr_aprobar)</td>
                    <td>@currency($modulo->vr_aprobado)</td>
                    <td>{!!$modulo->getState()!!}</td>
                    <td>
                        

                          <div class="btn-group"> 
                            @if ($permission->aedit) 
                                <button title="Generar pdf" onclick="pdf('{{route("{$slug}.pdf",['id'=>$modulo->id])}}')" class="btn btn-sm btn-frontera"><i class='bx bxs-file-pdf'></i></button>
                                <a class="btn hand btn-sm btn-info" href="{{route("{$slug}.items",['id'=>$contrato->id, 'item'=>$modulo->id])}}"><i class='bx bx-list-plus me-1' ></i></a>      
                                <button title="Editar" onclick="edit({{$modulo->id}})" class="btn btn-sm btn-success"><i class='bx bx-pencil' ></i></button>
                            @endif

                            @if ($permission->adelete)  
                                <a class="btn hand confirm btn-sm btn-danger" data-q='¿Desea eliminar este item?' href="{{route("{$slug}.delete",['id'=>$contrato->id, 'item'=>$modulo->id])}}"><i class="bx bx-trash me-1"></i></a>
                            @endif

                            

                          </div>


                    </td>
                  </tr>
                  @empty
                    <tr><td colspan="11">Sin registros</td></tr>
                  @endforelse
                </tbody>
                
              </table>
          </div>
        </div>
  </div>
@endsection

@section('addFooter')

        <script>
                 @if ($permission->aedit) 
       
                 pdf = function(url){
                    fn.dialog({
                                url : url,
                                type : 'post',
                                class: 'col-md-8'
                              });
                 }

                 addItem = function(){
                    fn.dialog({
                                url : '{{route("{$slug}.add",["id"=>$contrato->id])}}',
                                type : 'post',
                                class: 'col-md-10'
                              });
                 }
                 
                 @endif

                 @if ($permission->aedit)  
                 edit = function(id){
                    fn.dialog({
                                url : baseApp+'/{{$slugURL}}/'+id+'/edit',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->adelete)
                 borrar = function(id){
                      fn.dialog({
                                  url : baseApp+'/{{$slugURL}}/'+id+'/delete',
                                  type : 'post'
                                });
                  }
                 @endif
     
        </script>

@endsection