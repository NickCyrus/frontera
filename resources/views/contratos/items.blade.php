@php
    $slug = 'contratos.items';
    use Carbon\Carbon;
@endphp
@extends('app')
@section('content')
@include('contratos.part.cabecera')
<div class="card">
    <h5 class="card-header">
        @if ($permission->anew)
            <a class="btn btn-success pull-right  event-plus" href="{{route("{$slug}.add",['id'=>$contrato->id])}}">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar Items
            </a>
        @endif
        Item del contrato
    </h5>
    <div class="p-3">
      <table class="table table-striped dn-table">
        <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Code</th>
            <th>Aetos</th>
            <th>Nombre item</th>
            <th>Unidad de medida</th>
            <th align="right">Valor</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            @php $suma=0;@endphp
            @forelse($contrato->items()  as $modulo)
              @php   $suma += $modulo->value; @endphp
          <tr>
            <td>{{$modulo->id}}</td>
            <td>{{$modulo->code}}</td>
            <td>{{$modulo->aetos}}</td>
            <td>{{$modulo->description}}</td>
            <td>{{$modulo->getMeasure()}}</td>
            <td align="right">@currency($modulo->value)</td>
            <td>
                  @if ($permission->adelete)
                    <a class="dropdown-item hand confirm btn-danger" data-q='¿Desea eliminar este item?' href="{{route("{$slug}.delete",['id'=>$contrato->id, 'item'=>$modulo->id])}}"><i class="bx bx-trash me-1"></i> Borrar</a>
                  @endif
            </td>
          </tr>
          @empty
            <tr><td colspan="6">Sin registros</td></tr>
          @endforelse
        </tbody>

      </table>
    </div>
  </div>
@endsection

@section('addFooter')

        <script>
                 @if ($permission->aedit)

                 addItem = function(){
                    fn.dialog({
                                url : '{{route('contratos.items.add',['id'=>$contrato->id])}}',
                                type : 'post',
                                class: 'col-md-10'
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
