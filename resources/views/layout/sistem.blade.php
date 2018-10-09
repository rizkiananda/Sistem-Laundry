<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{URL::asset('img/wash.svg')}}" />
    <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.css')}}">   
    <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fontawesome5/css/all.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fontawesome5/webfonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fontawesome5/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/sweetalert.css')}}">
    

    @yield('styles')
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed" >
    @include('sistem.navbar')
    @include('sistem.menu')
  


    <div class="content-wrapper">

      <section class="content-header">
        <h1>
        @yield('title-header')
        </h1>
        
      </section>

      <section class="content">
        @yield('content')
        @yield('test')
      </section>

    </div>

    <footer class="main-footer">
      {{-- <strong>Sistem Informasi Manajemen Peneliti</strong>
      <strong class="pull-right">Pusat Studi Biofarmaka Tropika</strong> --}}
    </footer>
  </div>

</body>



  <script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  

  <script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>

  <script src="{{URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>

  <script src="{{URL::asset('plugins/fastclick/fastclick.js')}}"></script>

  <script src="{{URL::asset('dist/js/app.min.js')}}"></script>
  <script src="{{URL::asset('dist/js/adminlte.min.js')}}"></script>
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>

  <script src="{{URL::asset('js/sweetalert.min.js')}}"></script>
   @yield('script')



  </html>