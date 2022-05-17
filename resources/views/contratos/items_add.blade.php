@php
    $slug = 'contratos.items';
    use Carbon\Carbon;  
@endphp
@extends('app')
@section('content')
@include('contratos.part.cabecera' , ['backText'=>'items del contrato' , 'route'=> route('contratos.items',['id'=>$contrato->id])])
<div class="card">
    <h5 class="card-header">
        Agregar item al contrato
    </h5>
    <div class="p-3">
      <table class="table table-striped dn-table">
        <thead>
          <tr>
            <th style="width:10px"></th>
            <th>Code</th>
            <th>Aetos</th>
            <th>Nombre item</th>
            <th>Unidad de medida</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody>
             
            @forelse($items  as $modulo)
               
          <tr>
            <td><input type="checkbox"  value="{{$modulo->id}}" @if( $modulo->inContract($contrato->id) ) checked @endif onclick="addOrRemoveItem(this , this.value)" /></td>
            <td>{{$modulo->code}}</td>
            <td>{{$modulo->aetos}}</td>
            <td>{{$modulo->description}}</td>
            <td>{{$modulo->getMeasure()}}</td>
            <td>@currency($modulo->value)</td>
             
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

                function addOrRemoveItem(obj , id){

                    fn.ajax({
                        url : "{{route('contratos.ajax' , ['opc'=>'addItemContrato'])}}",
                        method :'post',
                        data : { idcontrato : {{$contrato->id}}, iditem : id , add : $(obj).is(':checked') }
                    })

                    var label =  ($(obj).is(':checked')) ? 'Item agregado correctamente' : 'Item removido correctamente';
                    $.amaran({
                        'message'   : label,
                        'position'  :'bottom right',
                        'inEffect'  :'slideBottom'
                    });

                }

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