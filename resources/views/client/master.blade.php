<!DOCTYPE html>
<!--
    ustora by freshdesignweb.com
    Twitter: https://twitter.com/freshdesignweb
    URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('public/client/css/bootstrap.min.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('public/client/css/font-awesome.min.css') }}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('public/client/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('public/client/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/client/css/responsive.css') }}">
    <link href="https://codeseven.github.io/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @if (session('toastr'))
        <script type="text/javascript">
            var TYPE_MESSAGE = "{{session('toastr.type')}}";
            var MESSAGE = "{{ session('toastr.message') }}";
        </script>
    @endif
    </head>
  <body>
   
    <!-- header -->
    @include('client.blocks.header')
    <!-- end header -->
       
    <!-- Content -->
    @yield('content')
    <!-- end Content -->
    
    <!-- footer -->
    @include('client.blocks.footer')
    <!-- end footer -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- <script type="text/javascript" srcs="{!! url('public/client/js/jquery.min.js') !!}"></script> -->
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="{!! url('public/client/js/bootstrap.min.js') !!}"></script> -->
    <!-- jQuery sticky menu -->
    <script src="{{ url('public/client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('public/client/js/jquery.sticky.js') }}"></script>
    
    <!-- jQuery easing -->
    <script src="{{ url('public/client/js/jquery.easing.1.3.min.js') }}"></script>
    
    <!-- Main Script -->
    <script src="{{ url('public/client/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <!-- Slider -->
    <script type="text/javascript" src="{{ url('public/client/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/client/js/script.slider.js') }}"></script>
    <script rel="javascript" type="text/javascript" src="{!! url('public/client/js/ajax.js') !!}" ></script>
    <script type="text/javascript">
        if (typeof TYPE_MESSAGE != "undefined") {
            switch (TYPE_MESSAGE) {
                case 'success':
                    toastr.success(MESSAGE)
                    break;
                case 'error':
                    toastr.error(MESSAGE)
                    break;
            }
        }
    </script>

  </body>
</html>