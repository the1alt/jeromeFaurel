@extends('layout')

@section('css')

    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" type="text/css"  href="{{asset('dist/magnific-popup.min.css')}}">
@endsection

@section('subnav')
  <div id="work-links" class="active">
      @foreach ($categories as $item)
        <a href="{{route('work.detail', ['link'=>$item->link])}}" class="{{ Route::current()->link === $item->link ? 'active' : '' }}">
          {{ $item->name }}
        </a>
      @endforeach
  </div>
@endsection

@section('content')
    <div class="image">
      <h1>{{ $categorie->name }}</h1>
      <ul class="grid effect" id="grid">
        @foreach ($projets as $key => $projet)
          <li>
            <div class="captionBox popup-gallery">
              <a href="{{$projet->images->url}}" @if($key === "0") class=" active-animation item-checked "@endif data-effect="mfp-with-fade" title="{{$projet->titre}}">
                <img src="{{$projet->images->url}}" alt="{{$projet->titre}}" class="shadow-img">
                <div class="caption full-caption"><h4>{{$projet->titre}}</h4><p>{{$projet->description}} </p></div>
                @if (!empty($projet->video))
                  <div class="hidden video">
                      {{$projet->video}}
                  </div>
                @endif
              </a>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
@endsection

@section('js')
  @parent
  <script src="{{asset('dist/detail.min.js')}}" charset="utf-8"></script>
@endsection
