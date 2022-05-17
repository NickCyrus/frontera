@php
$slug = 'items';
use Carbon\Carbon;  
@endphp

    <div class="container">

    <table class="table table-striped dt-responsive dt-tabla" id="tbl1">
        <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Código</th>
            <th>AETOS</th>
            <th>Descripción</th>
            <th>Unidad de Medida</th>
            <th>Valor Unitario</th>
            <th>Ultima Actualización</th>
           
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($items  as $modulo) 
          <tr>
            <td>{{$modulo->id}}</td>
            <td><strong>{{$modulo->code}}</strong></td>
            <td><strong>{{$modulo->aetos}}</strong></td>
            <td>{{$modulo->description}}</td>
            <td> </td>
            <td>@currency($modulo->value)</td>
            <td>{{Carbon::parse( $modulo->updated_at )->format('d/m/Y  H:i:s')}}</td>
          </tr>
          @empty
            <tr><td colspan="5">Sin registros</td></tr>
          @endforelse
        </tbody>
    </table>
    </div>
<script>
     $(document).ready(function(){
         
           
            fn.applyPlugins();
        
        
     })
</script>