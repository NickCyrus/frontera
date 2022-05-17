@php

    use Illuminate\Support\Facades\DB;

    if ($tbl){
        $key = (!isset($key)) ? 'id' : $key;
        if (!isset($orderby)) $orderby = '';
        if (!isset($where)) $where = '';
        
        $sql =  "SELECT  {$key} as id , {$label} as label  FROM {$tbl}
                 {$where} {$orderby} ";

        $row = DB::select($sql);
    }

@endphp
<select class="form-control" {{ $required ?? '' }}  name="{{ $name ?? '' }}" id="{{ $name ?? '' }}" onchange="{{$onchange ?? '' }}">
        <option value=""> Seleccionar </option>
        @foreach ($row as $item)
            @if (isset($value) && $value == $item->id )
                <option value="{{$item->id}}" selected >{{$item->label}}</option>
            @else
                <option value="{{$item->id}}" >{{$item->label}}</option>
            @endif
        @endforeach
</select>