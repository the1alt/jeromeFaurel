  <header class="navbar navbar-fixed-top {{ Route::currentRouteName() === 'welcome' ? 'loading' : '' }} ">
    <div class="navbar navbar-shadow">
      {{-- <div class="navbar-branding" > --}}
        <!-- Branding Image -->
        <img class="nav-logo {{ Route::currentRouteName() === 'welcome' ? 'hidden' : '' }}" src="{{asset('assets/img/logos/logo-xs.png')}}" alt="Jérôme FAUREL">
        <a class="nav-brand {{ Route::currentRouteName() === 'welcome' ? 'hidden' : '' }}" href="{{ url('/') }}">
          {{ config('app.name', 'Jérôme FAUREL') }}
        </a>
      {{-- </div> --}}
      <div id="btn-menu" class="{{ Route::currentRouteName() === 'welcome' ? 'center' : '' }} closed">
        <i class="fa fa-bars"></i>
      </div>
      <ul class="nav {{ Route::currentRouteName() === 'welcome' ? 'navbar-center' : 'navbar-nav navbar-right' }}">
        <div class="flex">
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
        </div>
      </ul>
    </div>
    @section('subnav')
    @show

</header>
