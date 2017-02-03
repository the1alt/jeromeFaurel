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

  <div class="container-fluid">
    <h1>Modifier une photo</h1>
    <div class="row" id="update">
      <div class="col-md-5" >
        <h2>Preview</h2>
        <div class="thumbnail">
           <img src="{{ $photo->image }}" alt="{{ $photo->image }}" width="300px">
           <div class="caption">
             <h3>{{ $photo->titre }}</h3>
             <p><i>{!! $photo->description !!}</i></p>
             <p>
               Vidéo :
               @if (is_null($photo->video))
                 pas de vidéo enregistrée
               @else
                  <a href="{{ $photo->video }}" class="btn btn-info" target="_blank"><i class="fa fa-movie text-success"></i></a>
               @endif
             </p>
             <p>
               <b>Visible : </b>
               @if ($photo->active)<i class="fa fa-check text-success"></i>
               @else <i class="fa fa-times text-danger"></i>
               @endif
             </p>
           </div>
         </div>
      </div>

      <div class="col-md-7">
        <h2>Formulaire de modification</h2>

        <!-- Begin: Admin Form -->
        <div class="admin-form theme-system">
          <div class="panel heading-border panel-system">
            <div class="panel-body bg-light">
              <form method="post" action=" {{ route('photos.update', $photo->id) }}" id="form-ui" enctype='multipart/form-data' >
                {{csrf_field()}}

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
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
                      <p class="help-block text-danger">
                        {{ $errors->first('titre') }}
                      </p>
                    @endif
                  </div> <!-- END COL-->
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
                </div><!-- END ROW-->

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="option-group field text-center">
                        <label class="block mt15 switch switch-system">
                          <input type="checkbox" name="active" id="active" value="1" @if($photo->active) checked @endif>
                          <label for="active" data-on="OUI" data-off="NON"></label>
                          <span>Faire apparaitre</span>
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
    <script src="{{asset('dist/summernote.min.js')}}"></script>
  @endsection
