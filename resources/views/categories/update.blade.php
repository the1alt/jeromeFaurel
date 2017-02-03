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

  <div class="container-fluid">
    <h1>Modifier une catégorie</h1>

    <div class="row" id="update"><!-- START COL PREVIEW-->
      <div class="col-md-5">
        <h2>Preview</h2>
        <div class="thumbnail">
           <div class="caption">
             <h3>{{ $categorie->name }}</h3>
             <p>
               <b>Visible : </b>
               @if ($categorie->active)<i class="fa fa-check text-success"></i>
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
              <form method="post" action=" {{ route('categories.update', $categorie->id) }}" id="form-ui" enctype='multipart/form-data' >
                {{csrf_field()}}

                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="smart-widget sm-left sml-50">
                        <label class="field">
                          <input type="text" name="name" id="name" class="gui-input" placeholder="Nom de la catégorie">
                        </label>
                        <label for="sm3" class="button">
                          <i class="fa fa-pencil"></i>
                        </label>
                      </div>
                    </div>
                    @if ($errors->has('name'))
                      <p class="help-block text-danger">
                        {{ $errors->first('name') }}
                      </p>
                    @endif
                  </div> <!-- END COL-->
                  <div class="col-md-10 col-md-offset-1">
                    <div class="section">
                      <div class="option-group field text-center">
                        <label class="block mt15 switch switch-system">
                          <input type="checkbox"  id="active" name="active" value="1" @if($categorie->active) checked @endif>
                          <label for="active" data-on="OUI" data-off="NON"></label>
                          <span >Faire apparaitre</span>
                        </label>
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
