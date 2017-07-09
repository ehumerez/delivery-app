<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delivery Chicken Style</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>

    <!-- Bootstrap 3.3.5 -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    
    
  </head>
  <body class="hold-transition skin-green sidebar-mini">
     
    <div class="box-body" style="display: flex;justify-content: center; align-content: center; flex-direction: column;">
    <div class="row">
      <div class="col-md-12">
              <!--Contenido-->
              @yield('contenido')
              <!--Fin Contenido-->
           </div>
        </div>            
    </div>
      <!--Fin-Contenido-->
  

    <!-- jQuery 2.1.4 -->    
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTESlKODX31wShJKvzn8Aiqige2qTZS0U&callback=myMap"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>
