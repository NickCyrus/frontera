@php
    $slug = 'items';
    use Carbon\Carbon;  
@endphp
@extends('app')
@section('content')
<div class="card">
    <h5 class="card-header">
        @if ($permission->anew)  
            <button type="button" class="btn btn-success pull-right  event-plus" onclick="add()">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar
            </button>
        @endif
        Items contratos
    </h5>
    <div class="p-3">
      <table class="table table-striped dn-table">
        <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Código</th>
            <th>AETOS</th>
            <th>Descripción</th>
            <th>Unidad de Medida</th>
            <th>Valor Unitario</th>
            <th>Ultima Actualización</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($modulos  as $modulo) 
          <tr>
            <td>{{$modulo->id}}</td>
            <td><strong>{{$modulo->code}}</strong></td>
            <td><strong>{{$modulo->aetos}}</strong></td>
            <td>{{$modulo->description}}</td>
            <td>{{$modulo->getMeasure()}}</td>
            <td>@currency($modulo->value)</td>
            <td>{{Carbon::parse( $modulo->updated_at )->format('d/m/Y  H:i:s')}}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @if ($permission->aedit)  
                    <a class="dropdown-item hand" onclick="edit({{$modulo->id}})"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  @endif
                  @if ($permission->adelete)  
                    <a class="dropdown-item hand confirm" data-q='¿Desea eliminar este modulo?' href="{{route("{$slug}.delete",['id'=>$modulo->id])}}"><i class="bx bx-trash me-1"></i> Delete</a>
                  @endif
                </div>
              </div>
            </td>
          </tr>
          @empty
            <tr><td colspan="5">Sin registros</td></tr>
          @endforelse
        </tbody>
         
      </table>
    </div>
  </div>
@endsection
 

@section('addFooter')

        <script>
                 @if ($permission->aedit) 
                 add = function(){
                    fn.dialog({
                                url : baseApp+'/{{$slug}}/add',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->aedit)  
                 edit = function(id){
                    fn.dialog({
                                url : baseApp+'/{{$slug}}/'+id+'/edit',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->adelete)
                 borrar = function(id){
                      fn.dialog({
                                  url : baseApp+'/{{$slug}}/'+id+'/delete',
                                  type : 'post'
                                });
                  }
                 @endif
                 
                    
                    
                    
 
        </script>

@endsection