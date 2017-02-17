@extends('layout')


@section('content')

  <div class="tray tray-center">
    <div class="container-fluid">
      <div class="row">
          @foreach ($categories as $key => $categorie)
            <div class="col-md-6 animated nav-box" data-test="@if($key%2 === 0)slideInLeft @else slideInRight @endif" >
              <a href="{{route('work.detail', ['id' => $categorie->id, 'link' => $categorie->link])}}">
              <div class="border shadow work-box">
                  <h2>{{ $categorie->name }}</h2>
                  <div class="move move-left">
                    <i class="fa fa-chevron-circle-left"></i>
                  </div>
                  <div class="work-img" >
                    <div class="items ">
                      @foreach ($categorie->projets as $clef => $projet)
                          <img src="{{$projet->images->url}}" alt="{{$projet->titre}}" class="img{{$clef}}">
                      @endforeach
                    </div>
                  </div>
                  <div class="move move-right">
                    <i class="fa fa-chevron-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>
            @if ($key%2 != 0 && $key != count($categories)-1)
              </div>
                <div class="split">
                  <img src="/assets/img/onde-sonore-back-4.png" alt="split" clas="img-responsive" id="nav-split">
                </div>
              <div class="row">
            @endif
          @endforeach
      </div>
    </div>
  </div>

@endsection
