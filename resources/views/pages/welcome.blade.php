@extends('layout')

@section('content')
  <div class="flex-center position-ref full-height">

      <div class="container-fluid ">
        <div class="row welcome">
          <div class="col-md-5 @if (!Auth::check())col-md-offset-1 @endif col-sm-offset-0 col-sm-6 logo-block text-right">
            <img src="assets/img/logos/logo.png" alt="Jérôme FAUREL logo" id="welcome-logo">
          </div>
          <div class="col-md-6 col-sm-6 titre-block">
            <h1 class="text-left">Jérôme FAUREL</h1>
            <h2 class="text-left">Ingénieur du son</h2>
          </div>
        </div>
      </div>
      <div class="split">
        <img src="/assets/img/onde-sonore-back-3.png" alt="split" class="img-responsive img-split">
      </div>
      <div class="container-fluid ">
        <div class="row actu welcome">
          <h3>Actu</h3>
          <div class="actu-block">
            <div class="row">
              <div class="col-md-1 col-sm-0 col-xs-0">
              </div>
              @foreach ($projets as $key => $projet)
                <div class="col-md-4 col-sm-4 col-xs-12 text-center"
                  <a href="/work/{{$projet->categories->link}}">
                    <figure>
                      <img src="{{ $projet->images->url }}" alt="{{ $projet->titre }}" class="shadow-img img-actu">
                    </figure>
                    <h4>{{ $projet->titre }}</h4>
                    <p>{{ $projet->description }}</p>
                  </a>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-0">
                </div>

              @endforeach
            </div>
          </div>
          </div>
      </div>
  </div>
@endsection
