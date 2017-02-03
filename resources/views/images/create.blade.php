@extends('layout')

@section('css')
    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('dist/forms.min.css')}}">

@endsection

@section('content')

  @if(Session::has('flash_message'))
       <div class="alert alert-success fade in">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ Session::get('flash_message') }}
       </div>
   @endif

  <section id="content" class=" animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="content">

        <div class="center-block">

          <!-- Begin: Content Header -->
          <div class="content-header">
            <h2> Ajouter une image</h2>
          </div>

          <!-- Begin: Admin Form -->
          <div class="admin-form theme-primary">
            <div class="panel heading-border panel-primary">
              <div class="panel-body bg-light">
                <form method="post" action=" {{ route('images.create') }}" id="form-ui" enctype='multipart/form-data' >

                  {{csrf_field()}}
                  <div class="section-divider mb40" id="spy1">
                    <span>Informations principales</span>
                  </div>
                  <!-- .section-divider -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="section">
                        <label class="field select">
                          <select id="categorie" name="categorie" class="form-control">
                            <option value="" selected disabled>Type de projet</option>
                            @foreach ($categories as $categorie)
                              <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                          </select>
                          <i class="arrow"></i>
                        </label>
                      </div>
                      @if ($errors->has('categorie'))
                         <p class="help-block text-danger text-center">
                             {{ $errors->first('categorie') }}
                         </p>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="section">
                        <label for="image" class="field file">
                          <span class="button btn-primary"> Image </span>
                          <input type="file" class="gui-file" name="image" id="image" onchange="document.getElementById('uploader1').value = this.value;" accept="image/*" capture="capture">
                          <input type="text" class="gui-input" id="uploader1" placeholder="Aucune image sélectionnée" readonly="">
                        </label>
                      </div>
                      @if ($errors->has('image'))
                        <p class="help-block text-danger text-center">
                          {{ $errors->first('image') }}
                        </p>
                      @endif
                    </div>
                  </div>
                  <div class="row text-center">
                    <button type="submit" name="button" class="btn btn-primary">Valider</button>
                  </div>
                </form>
              </div>
            </div>

          </div>

        </div>
      </div>
      <!-- end: .tray-center -->
  </section>
@endsection
