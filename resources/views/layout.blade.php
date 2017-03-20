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
  <link rel="stylesheet" type="text/css" href="{{asset('dist/theme.min.css')}}">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('assets/img/logos/logo-xs.png')}}">

  @section('css')
  @show

  {{-- Ma CSS --}}
  <link rel="stylesheet" href="{{asset('dist/main.min.css')}}" media="screen" title="no title">

</head>

<body class="blank-page @if (Auth::check()) sb-l-o @else sb-l-c @endif ">


  <!-- Start: Main -->
  <div id="main">

    <!-- Start: Header -->
    @include('partials/_header')
    <!-- End: Header -->

    <!-- Start: Sidebar -->
    @include('partials/_sidebar')
    <!-- End: Sidebar -->

    <div class="div-load">
      <div class="loader" >
        Loading...
      </div>
    </div>
    <!-- Start: Content -->

    <section id="content_wrapper" class="loading">
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

  @section('js')

  <!-- jQuery &  Theme Javascript -->
  <script src="{{asset('dist/main.js')}}"></script>


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
    Core.init();


});
  </script>

  @show

  <!-- Custom script -->
  <script src="{{asset('dist/custom.min.js')}}" charset="utf-8"></script>

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
