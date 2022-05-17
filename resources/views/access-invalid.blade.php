@extends('app-empty')

@section('addCss')
    <style>
        .misc-wrapper{display:flex;flex-direction:column;justify-content:center;align-items:center;min-height:calc(100vh - (1.625rem * 2));text-align:center}
    </style>
@endsection    
@section('content')

<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Acceso no permitido :(</h2>
      <p class="mb-4 mx-2">Oops! 😖 no tienes acceso a esta URL.</p>
      <a href="{{route('home')}}" class="btn btn-primary">Ir al inicio</a>
      <div class="mt-3">
        <img src="../assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png">
      </div>
    </div>
  </div>
@endsection