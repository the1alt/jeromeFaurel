@extends('layout')

@section('css')
    <!-- Admin Forms & Summernotes CSS -->
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
            <h2> Ajouter une photo</h2>
          </div>

          <!-- Begin: Admin Form -->
          <div class="admin-form theme-primary">
            <div class="panel heading-border panel-primary">
              <div class="panel-body bg-light">
                <form method="post" action=" {{ route('photos.create') }}" id="form-ui" enctype='multipart/form-data' >

                  {{csrf_field()}}
                  <div class="section-divider mb40" id="spy1">
                    <span>Informations principales</span>
                  </div>
                  <!-- .section-divider -->
                  <div class="row">
                    <div class="col-md-9">
                      <div class="section">
                        <div class="smart-widget sm-left sml-50">
                          <label class="field">
                            <input type="text" name="titre" id="titre" class="gui-input" placeholder="Titre de la photo">
                          </label>
                          <label for="sm3" class="button">
                            <i class="fa fa-pencil"></i>
                          </label>
                        </div>
                      </div>
                      @if ($errors->has('titre'))
                        <p class="help-block text-danger text-center">
                          {{ $errors->first('titre') }}
                        </p>
                      @endif
                    </div>
                    <div class="col-md-3">
                      <div class="section">
                        <div class="option-group field">
                          <label class="block mt15 switch switch-primary">
                            <input type="checkbox" name="active" id="active" value="1">
                            <label for="active" data-on="OUI" data-off="NON"></label>
                            <span >Faire apparaitre</span>
                          </label>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="row">
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
                    <div class="col-md-6">
                      <div class="section">
                        <label class="field prepend-icon">
                          <input type="url" name="video" id="video" class="gui-input" placeholder="video">
                          <label for="trailer" class="field-icon">
                            <i class="fa fa-globe"></i>
                          </label>
                        </label>
                      </div>
                      @if ($errors->has('video'))
                        <p class="help-block text-danger text-center">
                          {{ $errors->first('video') }}
                        </p>
                      @endif
                    </div>
                  </div>
                  <div class="section-divider mb40" id="spy1">
                    <span>Description</span>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="section">
                        <textarea type="text" name="description" class="summernote"></textarea>
                      </div>
                      @if ($errors->has('description'))
                        <p class="help-block text-danger text-center">
                          {{ $errors->first('description') }}
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

@section('js')
  @parent
  <!-- Summernote Plugin -->
  <script src="{{asset('dist/summernote.min.js')}}"></script>
@endsection
