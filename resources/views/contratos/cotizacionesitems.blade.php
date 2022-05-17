@php
    $slug = 'contratos.items';
    use Carbon\Carbon;
@endphp
@extends('app')
@section('content')
@include('contratos.part.cabecera' , ['backText'=>'cotizaciones del contrato' , 'route'=> route('contratos.cotizaciones',['id'=>$contrato->id])])



<div class="card">
    <h5 class="card-header">
        <div class="row">
            <div class="col-md-4">
                Items de la cotización
            </div>

            <div class="col-md-4">
                Estado de cotización  {!!$cotizacion->getState()!!}
            </div>

            <div class="col-md-4"> 
              Total : <b> @currency($cotizacion->vr_creada)</b>
           </div>

        </div>

    </h5>
    </h5>
    <div class="p-3">
      <table class="table table-striped dn-table">
        <thead>
          <tr>

            <th>Aetos</th>
            <th>Nombre item</th>
            <th>Unidad de medida</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @php $suma=0;@endphp
            @forelse($items_cotizacion  as $modulo)
              @php   $total = $modulo->getItemPrice() * $modulo->item_quantity ;   @endphp
          <tr>
            <td>{{$modulo->getItEatos()}}</td>
            <td>{{$modulo->getItemName()}}</td>
            <td>{{$modulo->getMeasure()}}</td>
            <td>{{$modulo->item_quantity}}</td>
            <td>@currency($modulo->getItemPrice())</td>
            <td>@currency($total)</td>

            <td>
                @if ($cotizacion->state !=3)
              <a class="btn btn-sm btn-danger" href="{{route('contratos.cotizaciones.item.delete', ['id'=>$contrato->id, 'item'=>$cotizacionid , 'iditem'=> $modulo->id] )}}" ><i class="bx bx-trash me-1"></i></a></td>
                @endif

          </tr>
          @empty
            <tr><td colspan="8">Sin registros</td></tr>
          @endforelse
        </tbody>

      </table>
    </div>
  </div>

  <div class="card mt-3">
    <h5 class="card-header">
        Items del contrato
    </h5>
    <div class="p-3">
      <table class="table table-striped dn-table">
        <thead>
          <tr>
            <th style="width:10px">#</th>

            <th>Aetos</th>
            <th>Nombre item</th>
            <th>Unidad de medida</th>
            <th align="right">Valor</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @php $suma=0;@endphp
            @forelse($contrato->itemsNotInclude($cotizacionid)  as $modulo)
              @php   $suma += $modulo->value; @endphp
          <tr>

            <td>{{$modulo->code}}</td>
            <td>{{$modulo->aetos}}</td>
            <td>{{$modulo->description}}</td>
            <td>{{$modulo->getMeasure()}}</td>
            <td align="right">@currency($modulo->value)</td>
            <td>
                @if ($cotizacion->state !=3)
                    <button class="btn btn-sm btn-success" onclick="addItem({{$modulo->id}})"> <i class='bx bx-plus' ></i> Agregar </button>
                @endif
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

                 addItem = function(id){
                    fn.dialog({
                                url : "{{route('contratos.cotizaciones.item.add', ['id'=>$contrato->id, 'item'=>$cotizacionid , 'iditem'=>''] )}}/"+id,
                                type : 'post',
                                class: 'col-md-6'
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
