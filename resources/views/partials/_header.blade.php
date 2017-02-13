  <header class="navbar navbar-fixed-top ">
    <div class="navbar navbar-shadow">
      <div class="navbar-branding" >
        <!-- Branding Image -->
        <img class="navbar-brand" src="{{asset('assets/img/logos/logo-xs.png')}}" alt="Jérôme FAUREL">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Jérôme FAUREL') }}
        </a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li>

          <a href="/" class="{{ Route::currentRouteName() === 'welcome' ? 'active' : '' }}" ><i class="fa fa-home"></i> HOME</a>
        </li>
        <li>
          <a href="/work"  class="{{ strpos(Route::currentRouteName(), 'work') === 0 ? 'active' : '' }}" ><i class="fa fa-film"></i> WORK</a>
        </li>
        <li>
          <a href="/photos"  class="{{ strpos(Route::currentRouteName(), 'photos') === 0 ? 'active' : '' }}" ><i class="fa fa-camera"></i> PHOTOS</a>
        </li>
        <li>
          <a href="/about"  class="{{ Route::currentRouteName() === 'about' ? 'active' : '' }}" ><i class="fa fa-info"></i> ABOUT</a>
        </li>
        <li>
          <a href="/contact"  class="{{ Route::currentRouteName() === 'contact' ? 'active' : '' }}" ><i class="fa fa-envelope"></i> CONTACT</a>
        </li>
      </ul>
    </div>
    @section('subnav')
    @show

</header>
