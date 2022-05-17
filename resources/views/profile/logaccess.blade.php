@php
   use Carbon\Carbon;  
@endphp
@extends('app')

@section('content')

 
            
    <div class="card">
            <div class="card-header">
                <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Mi perfil /</span> perfil
                </h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive text-nowrap">
                        
                        <table class="table table-striped ">
                                <tr>
                                    <td>Fecha</td>
                                    <td>IP</td>
                                    <td>Divice</td>
                                    <td>Agent</td>
                                    <td>Evento</td>
                                </tr>
                                @forelse($userlog as $log)
                                    <tr>
                                        <td>{{Carbon::parse( $log->created_at )->format('d/m/Y T H:i')}}</td>
                                        <td>{{$log->ipaccess}}</td>
                                        <td>{{$log->device}}</td>
                                        <td>{{$log->agent}}</td>
                                        <td>{{$log->event}}</td>
                                    </tr>
                                @empty

                                @endforelse
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="5">{!! $userlog->links('vendor.pagination.bootstrap-5') !!}</td>
                                    </tr>
                                </tfoot>
                                
                        </table>

                    </div>   
                </div>
            </div>
        </div>
    </div>
 

@endsection