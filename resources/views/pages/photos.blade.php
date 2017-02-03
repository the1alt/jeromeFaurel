@extends('layout')

@section ('css')
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" type="text/css"  href="{{asset('dist/magnific-popup.min.css')}}">
@endsection

@section('content')

  <div class="image">
    <ul class="grid effect" id="grid">
      @foreach ($photos as $key => $photo)
        <li>
          <div class="captionBox popup-gallery">
            <a href="{{$photo->image}}"data-effect="mfp-with-fade" title="{{$photo->titre}}">
              <img src="{{$photo->image}}" alt="{{$photo->titre}}" class="shadow-img">
              <div class="caption full-caption"><h4>{{$photo->titre}}</h4><p>{{$photo->description}}</p></div>
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
