@php
   use Carbon\Carbon;  
@endphp
@extends('app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
            
            
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Mi perfil /</span> perfil
    </h4>

<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="user-profile-header-banner">
          <img src="assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
        </div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
          <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
             @if(Auth::User()->getAvatar(true))   
                    <img src="{{asset('assets/')}}{{Auth::User()->getAvatar(true)}}" alt="{{Auth::User()->name}}" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
             @endif
          </div>
          <div class="flex-grow-1 mt-3 mt-sm-5">
            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
              <div class="user-profile-info">
                <h4>{{Auth::User()->name}}</h4>
                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                  <li class="list-inline-item fw-semibold">
                    <i class="bx bx-pen"></i> {{Auth::User()->getNameRol()}}
                  </li>
                  
                </ul>
              </div>
              <a href="javascript:void(0)" class="btn btn-success text-nowrap">
                <i class="bx bx-user-check"></i> Conectado
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
          <div class="card-body">
            <small class="text-muted text-uppercase">Acerca de</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Nombre:</span> <span>{{Auth::User()->name}}</span></li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Estado:</span> <span>Active</span></li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Perfil:</span> <span>{{Auth::User()->getNameRol()}}</span></li>
              <li>
                <span class="fw-semibold mx-2">Cambiar password:</span>
                <form action="{{route('profile.changepassword')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-6">
                         <input required type="password" name="password" class="form-control" />
                      </div>
                      <div class="col-4">
                          <button class="btn btn-success">Cambiar</button>
                      </div>
                </form>
              </li>
              

            </ul>
            <!--
            <small class="text-muted text-uppercase">Contacts</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span> <span>(123) 456-7890</span></li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-chat"></i><span class="fw-semibold mx-2">Skype:</span> <span>john.doe</span></li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span> <span>john.doe@example.com</span></li>
            </ul>
             !-->
          </div>
        </div>
        <!--/ About User -->
         
         
            <!-- Connections -->
            <div class="col-lg-12 col-xl-12 mt-4">
              <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                  <h5 class="card-action-title mb-0">Conecciones</h5>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled mb-0">
                    @forelse (Auth::User()->getLogConection(7) as $conx)
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="me-2">
                              <h6 class="mb-0">{{$conx->device}}/{{$conx->agent}}</h6>
                              <small class="text-muted"><b>{{$conx->event}}</b> - {{Carbon::parse( $conx->created_at )->format('d/m/Y T H:i')}}</small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-label-primary btn-icon btn-sm">
                               @if ($conx->event == 'Login')
                                <i class='bx bx-log-in'></i>
                               @else
                                <i class="bx bx-log-out"></i>
                               @endif 
                            </button>
                          </div>
                        </div>
                      </li>   
                    @empty
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                          <div class="d-flex align-items-start">
                            <div class="me-2">
                              <h6 class="mb-0">Sin información</h6>
                              <small class="text-muted"></small>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                          </div>
                        </div>
                      </li>
                    @endforelse
                    
                     
                    <li class="text-center">
                      <a href="{{route('logaccess')}}">Ver todas las conexiones</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--/ Connections -->
         
      </div>

      <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Actividad</h5>
          </div>
          <div class="card-body">
            <ul class="timeline ms-2">

                @forelse (Auth::User()->getLogAcction(15) as $acction)
                
              <li class="timeline-item timeline-item-transparent">
                <span class="timeline-point timeline-point-warning"></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">{!!$acction->comment!!}</h6>
                    <small class="text-muted">{{Carbon::parse( $acction->created_at )->format('d/m/Y T H:i')}}</small>
                  </div>
                  <p class="mb-2">IP {{$acction->ipaccess}}</p>
                   
                </div>
              </li>
              @empty
                <li class="timeline-item timeline-item-transparent">
                    <div class="timeline-event">
                        <div class="timeline-header mb-1">
                          <h6 class="mb-0">Sin acciones</h6>
                        </div>
                </li>
              @endforelse
              <li class="timeline-end-indicator">
                <i class="bx bx-check-circle"></i>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Activity Timeline -->
     

      <!-- end row !-->
  </div>

</div>

@endsection