@extends('app-empty')

@section('addCss')
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
@endsection

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="{{ route('login') }}" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">{{env('APP_NAME')}}</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2 text-center">Bienvenid@ al administador</h4>
            <p class="mb-4 text-center">Por favor ingresa tus datos de acceso </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="correo@dominio.ext" autofocus />
                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <!--
                    <a href="auth-forgot-password-basic.html">
                        <small>Forgot Password?</small>
                    </a>
                  !-->
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
              </div>
              <!--
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              !-->
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Acceder</button>
              </div>
            </form>

             
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

@endsection