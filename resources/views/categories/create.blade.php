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
            <h2> Ajouter une catégorie</h2>
          </div>

          <!-- Begin: Admin Form -->
          <div class="admin-form theme-primary">
            <div class="panel heading-border panel-primary">
              <div class="panel-body bg-light">
                <form method="post" action=" {{ route('categories.create') }}" id="form-ui" enctype='multipart/form-data' >

                  {{csrf_field()}}
                  <div class="section-divider mb40" id="spy1">
                    <span>Formulaire</span>
                  </div>
                  <!-- .section-divider -->
                  <div class="row">
                    <div class="col-md-9">
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
                    </div>
                    @if ($errors->has('name'))
                      <p class="help-block text-danger text-center">
                        {{ $errors->first('titre') }}
                      </p>
                    @endif
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
