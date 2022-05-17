<!DOCTYPE html>
<html
  lang="es"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets')}}">
  <head> 
    <meta charset="utf-8" />
    <meta  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fronteras</title>
    <meta name="description" content="" />

    <!-- Favicon 
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
-->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />

    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/jquery.dataTables.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link href="{{ asset('assets/plugins/jconfirm/css/jquery-confirm.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/amaranjs/dist/css/amaran.min.css') }}" rel="stylesheet">    

    <!-- <link rel="stylesheet" href="{{asset('assets/css/core.css')}}" />  !-->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    @yield('addCss')

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <script> var baseApp =  "{{ env('APP_URL')}}" </script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        @include('menuLeft')

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('navBar')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                
                @yield('content')

            </div>
            <!-- / Content -->

            
            @include('footer')
            
            

            
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

     
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/plugins/jconfirm/js/jquery-confirm.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->
 
    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/functions.js')}}"></script>
    <!-- Page JS -->
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}} "></script>
    <script src="{{asset('assets/plugins/datatables/datatables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/plugins/amaranjs/dist/js/jquery.amaran.js')}}"></script>

    @yield('addFooter')

   
    @if( @session('alert-success'))

    <script>
      Swal.fire(
        'Confirmación',
        '{{@session('alert-success')}}',
        'success'
      )
    </script>

    @endif
    @if(@session('alert-danger'))
      <script>
        Swal.fire(
          'Alerta',
          '{{@session('alert-danger')}}',
          'error'
        )
      </script>
    @endif
    
  </body>
</html>