@php
   use Carbon\Carbon;  
@endphp
@extends('app')

@section('content')

 
            
    <div class="card">
            <h5 class="card-header"> Logs de usuarios</h5>
            <div class="row">
                <div class="col-12">
                    <div class="p-3">
                        
                        <table class="table table-striped dn-table ">
                            <thead>
                                <tr>
                                    <td>Fecha</td>
                                    <td>Usuario</td>
                                    <td>IP</td>
                                    <td>Comentario</td>
                                    <td>Acción</td>
                                </tr>
                            </thead>
                                <tbody>
                                        @forelse($logs as $log)
                                            <tr>
                                                <td>{{Carbon::parse( $log->created_at )->format('d/m/Y T H:i')}}</td>
                                                <td>{{$log->ipaccess}}</td>
                                                <td>{{$log->user()}}</td>
                                                <td>{!!$log->comment!!}</td>
                                                <td>{{$log->action}}</td>
                                            </tr>
                                        @empty
                                        
                                        @endforelse
                            </tbody>
                        </table>

                    </div>   
                </div>
            </div>
        </div>
    </div>
@endsection