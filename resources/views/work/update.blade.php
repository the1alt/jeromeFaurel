@extends('layout')
@section('css')
  <!-- Admin Forms & Summernotes CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('dist/forms.min.css')}}">
    <!-- Selectpicker CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

@endsection

@section('content')

  @if(Session::has('flash_message'))
       <div class="alert alert-success fade in">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ Session::get('flash_message') }}
       </div>
   @endif

  <div class="container-fluid">
    <h1>Modifier un projet</h1>

    <div class="row" id="update"><!-- START COL PREVIEW-->
      <div class="col-md-5">
        <h2>Preview</h2>
        <div class="thumbnail">
           <img src="{{ $projet->images->url }}" alt="{{ $projet->image }}" class="img-responsive">
           <div class="caption">
             <h3>{{ $projet->titre }}</h3>
             <p><i>{!! $projet->description !!}</i></p>
             <p>
               Vidéo :
               @if (is_null($projet->video))
                 pas de vidéo enregistrée
               @else
                  <a href="{{ $projet->video }}" class="btn btn-info" target="_blank"><i class="fa fa-movie text-success"></i></a>
               @endif
             </p>
             <p>
               <b>Visible : </b>
               @if ($projet->active)<i class="fa fa-check text-success"></i>
               @else <i class="fa fa-times text-danger"></i>
               @endif
             </p>
           </div>
         </div>
      </div> <!-- END COL PREVIEW-->

      <div class="col-md-7"><!-- START COL FORM-->
        <h2>Formulaire de modification</h2>
        <!-- Begin: Admin Form -->
        <div class="admin-form theme-system">
          <div class="panel heading-border panel-system">
            <div class="panel-body bg-light">
              <form method="post" action=" {{ route('work.update', $projet->id) }}" id="form-ui" enctype='multipart/form-data' >
                {{csrf_field()}}

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
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
                  </div> <!-- END COL-->
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="smart-widget sm-left sml-50">
                        <label class="field">
                          <input type="text" name="titre" id="titre" class="gui-input" placeholder="Titre du projet">
                        </label>
                        <label for="sm3" class="button">
                          <i class="fa fa-pencil"></i>
                        </label>
                      </div>
                    </div>
                    @if ($errors->has('titre'))
                       <p class="help-block text-danger">
                           {{ $errors->first('titre') }}
                       </p>
                    @endif
                  </div> <!-- END COL-->
                </div>

                <div class="section-divider mb40" id="spy1"><span>Image</span></div>

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="form-group">
                        <select title="picture" class="selectpicker form-control" name="picture"  id="picture">
                          <option value="0" selected disabled>Choisir une image préexistante</option>
                          @foreach ($images as $image)
                            <option value="{{ $image->id }}" data-content='<img src="{{ $image->url }}" alt="{{ $image->title }}" class="img-responsive"> ' > 1 </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div> <!-- END COL-->
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <label for="image" class="field file">
                        <span class="button btn-system"> Image </span>
                        <input type="file" class="gui-file" name="image" id="image" onchange="document.getElementById('uploader1').value = this.value;" accept="image/*" capture="capture">
                        <input type="text" class="gui-input" id="uploader1" placeholder="Aucune image sélectionnée" readonly="">
                      </label>
                    </div>
                  </div> <!-- END COL-->
                </div>

                <div class="section-divider mb40" id="spy1"><span>Autre</span></div>

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <label class="field prepend-icon">
                        <input type="url" name="video" id="video" class="gui-input" placeholder="video">
                        <label for="trailer" class="field-icon">
                          <i class="fa fa-globe"></i>
                        </label>
                      </label>
                    </div>
                  </div><!-- END COL-->
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="option-group field text-center">
                        <label class="block mt15 switch switch-system">
                          <input type="checkbox" name="active" id="active" value="1" @if($projet->active) checked @endif>
                          <label for="active" data-on="OUI" data-off="NON"></label>
                          <span >Faire apparaitre</span>
                        </label>
                      </div>
                    </div>
                  </div><!-- END COL-->
                </div><!-- END ROW-->

                <div class="section-divider mb40" id="spy1">
                  <span>Description</span>
                </div>

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="panel">
                        <div class="panel-body pn of-h" id="summer-demo">
                          <textarea type="text" name="description" class="summernote" style="height: 400px;"></textarea>
                        </div>
                      </div>
                    </div>
                  </div><!-- END COL-->
                </div><!-- END ROW-->

                <div class="row">

                </div><!-- END ROW-->

                <div class="row text-center">
                  <button type="submit" name="button" class="btn btn-system">Valider</button>
                </div><!-- END ROW-->

              </form>
            </div><!-- END PANEL-BODY-->
          </div><!-- END PANEL-->
        </div><!-- END ADMIN-FORM-->
      </div><!-- END COL FORM -->

    </div><!-- END ROW MAIN-->
  </div><!-- END CONTAINER-->



  @endsection

  @section('js')
    @parent


    <!-- Summernote Plugin -->
    <script src="{{asset('dist/summernotes.min.js')}}"></script>
    <!-- Selectpicker Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

  @endsection
