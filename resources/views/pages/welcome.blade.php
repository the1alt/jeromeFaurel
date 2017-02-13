@extends('layout')

@section('content')
  <div class="flex-center position-ref full-height">

      <div class="container welcome">
        <div class="row">
          <div class="col-md-6 logo-block text-right">
            <img src="assets/img/logos/logo.png" alt="Jérôme FAUREL logo" id="welcome-logo">

          </div>
          <div class="col-md-6 titre-block">
            <h1 class="text-left">Jérôme FAUREL</h1>
            <h2 class="text-left">Ingénieur du son</h2>
          </div>
        </div>
          <div class="row actu">
            <h3>Actu</h3>
            <div id="carousel" class="carousel slide" data-ride="carousel">

              <!-- Indicators -->
              <ol class="carousel-indicators">
                @foreach ($projets as $key => $projet)
                  <li data-target="#carousel" data-slide-to="{{$key}}" @if ($key===1) class="active" @endif></li>
                @endforeach
              </ol>
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                @foreach ($projets as $key => $projet)
                  <div class="item @if ($key===1) active @endif">
                    <img src="{{$projet->images->url}}" alt="{{$projet->titre}} ">
                    <div class="carousel-caption">
                      {{$projet->titre}}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
      </div>
  </div>
@endsection
