<!DOCTYPE html>
<html>

<head>
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta name="language" content="fr">
  @section('title')
    <title>Jérôme FAUREL</title>
  @show
  <meta name="keywords" content="jerome, faurel, ingénieur, son, film, bande-annonce, pub, long-mettrage, court-metrage, montage, pré-mixage, mastering, perchiste, animation, dessins animés" />
  <meta name="description" content="Jérôme FAUREL - Ingénieur du son. Retrouvez tous mes projets réalisés ou en cours et des photos de tournage/mixage. N'hésitez pas à me contacter si vous avez un projet à réaliser et que vous souhaitez en discuter.">
  <meta name="author" content="The-alt">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <!-- Font CSS (Via CDN) -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Spinnaker" rel="stylesheet" type='text/css'>

  <!-- Theme CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


  <link rel="stylesheet" href="{{asset('dist/theme.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('skin/default_skin/css/theme.css')}}"> --}}

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('assets/img/logos/logo-xs.png')}}">

  @section('css')
  @show

  {{-- Ma CSS --}}
  <link rel="stylesheet" href="{{asset('dist/main.css')}}" media="screen" title="no title">

</head>

<body class="blank-page">


  <!-- Start: Main -->
  <div id="main">

    <!-- Start: Header -->
    @include('partials/_header')
    <!-- End: Header -->

    @if (Auth::check())
        <!-- Start: Sidebar -->
        @include('partials/_sidebar')
        <!-- End: Sidebar -->
    @endif

    <div class="div-load">
      <div class="loader" >
        Loading...
      </div>
    </div>
    <!-- Start: Content -->

    <section id="content_wrapper" class="loading @if(Auth::check())admin @endif">
        <section id="content" >
          @section('content')
          @show
        </section>
    </section>
      <!-- End: Content -->

  </div>
  <!-- End: Main -->
  <footer>
    <p>
      &copy; 2017 Jérôme FAUREL | Tous droits réservés | Created by The-Alt |
      @if (Route::has('login'))
        @if (Auth::check())
          <a href="{{ url('/logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>
        @else
          <a href="{{ url('/login') }}">Login</a>
        @endif
      @endif
  </p>

  </footer>
  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery & theme Javascript -->
  <script src="{{asset('dist/jquery.min.js')}}"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  @section('js')



  <script type="text/javascript">

  jQuery(document).ready(function() {

    "use strict";

    $(window).load(function() {
      $('#content_wrapper').removeClass('loading');
      if ($('header').hasClass('loading')) {
        $('header').removeClass('loading');
      }
      $('.div-load').addClass('loaded');
    });

    if ($('body').hasClass('sb-l-o')) {
      $('.div-load').css('left', '150px')
    }
    // Init Theme Core
    // Core.init();


});
  </script>

  @show

  {{-- <script src="{{asset('vendor/plugins/jquery.sidebar/src/jquery.sidebar.js')}}" charset="utf-8"></script> --}}

  <!-- Custom script -->
  <script src="{{asset('dist/custom.js')}}" charset="utf-8"></script>

  <!-- google analitycs -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-94040215-1', 'auto');
    ga('send', 'pageview');
  </script>
  <!-- END: PAGE SCRIPTS -->



</body>

</html>
