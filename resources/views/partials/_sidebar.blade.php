<div class="sidebar left">


  <div class="sidebar-widget author-widget ">
    <div class="media">
      <a class="media-left" href="#">
        <img src="{{ asset('assets/img/logos/logo-xs.png')}}" class="img-responsive">
      </a>
      <div class="media-body">
        <div class="media-links">
           <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
               Logout
           </a>

           <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
               {{ csrf_field() }}
           </form>
        </div>
        <div class="media-author">Jérôme FAUREL</div>
      </div>
    </div>
  </div>
  <ul class="nav sidebar-menu">
    <li class="sidebar-label pt20">Menu Admin</li>
    <li>
      <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'categories') === 0 ? 'menu-open' : '' }}" href="#">
        <span class="fa fa-tags"></span>
        <span class="sidebar-title">Catégories</span>
        <span class="caret"></span>
      </a>
      <ul class="nav sub-nav">
        <li class="{{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
          <a  href="/admin/categories/index">
            <span class="fa fa-desktop"></span>
            Index
          </a>
        </li>
        <li  class="{{ Route::currentRouteName() === 'categories.create' ? 'active' : '' }}">
          <a href="/admin/categories/create">
            <span class="fa fa-plus"></span>
            Create
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'work') === 0 ? 'menu-open' : '' }}" href="#">
        <span class="fa fa-film"></span>
        <span class="sidebar-title">Work</span>
        <span class="caret"></span>
      </a>
      <ul class="nav sub-nav">
        <li class="{{ Route::currentRouteName() === 'work.index' ? 'active' : '' }}">
          <a  href="/admin/work/index">
            <span class="fa fa-desktop"></span>
            Index
          </a>
        </li>
        <li class="{{ Route::currentRouteName() === 'work.create' ? 'active' : '' }}">
          <a  href="/admin/work/create">
            <span class="fa fa-plus"></span>
            Create
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'photos') === 0 ? 'menu-open' : '' }}" href="#">
        <span class="fa fa-camera"></span>
        <span class="sidebar-title">Photos</span>
        <span class="caret"></span>
      </a>
      <ul class="nav sub-nav">
        <li class="{{ Route::currentRouteName() === 'photos.index' ? 'active' : '' }}">
          <a  href="/admin/photos/index">
            <span class="fa fa-desktop"></span>
            Index
          </a>
        </li>
        <li class="{{ Route::currentRouteName() === 'photos.create' ? 'active' : '' }}">
          <a  href="/admin/photos/create">
            <span class="fa fa-plus"></span>
            Create
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'images') === 0 ? 'menu-open' : '' }}" href="#">
        <span class="fa fa-picture-o"></span>
        <span class="sidebar-title">Images</span>
        <span class="caret"></span>
      </a>
      <ul class="nav subnav">
        <li  class="{{ Route::currentRouteName() === 'images.index' ? 'active' : '' }}">
          <a  href="/admin/images/index">
            <span class="fa fa-desktop"></span>
            <span class="sidebar-title">Index</span>
          </a>
        </li>
        <li  class="{{ Route::currentRouteName() === 'images.create' ? 'active' : '' }}">
          <a  href="/admin/images/create">
            <span class="fa fa-plus"></span>
            Create
          </a>
        </li>
      </ul>
    </li>
  </ul>
  <div class="admin-mobile-access">
    <i class="fa fa-arrow-right"></i>
  </div>

</div>



{{-- <aside id="sidebar_left" class="nano nano-light affix">

  <!-- Start: Sidebar Left Content -->
  <div class="sidebar-left-content nano-content">


      <!-- Sidebar Widget - Author (hidden)  -->
      <div class="sidebar-widget author-widget ">
        <div class="media">
          <a class="media-left" href="#">
            <img src="{{ asset('assets/img/logos/logo-xs.png')}}" class="img-responsive">
          </a>
          <div class="media-body">
            <div class="media-links">
               <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                   Logout
               </a>

               <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
            </div>
            <div class="media-author">Jérôme FAUREL</div>
          </div>
        </div>
      </div>

    </header>
    <!-- End: Sidebar Header -->

    <!-- Start: Sidebar Menu -->
    <ul class="nav sidebar-menu">
      <li class="sidebar-label pt20">Menu Administrateur</li>
      <li>
        <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'categories') === 0 ? 'menu-open' : '' }}" href="#">
          <span class="fa fa-tags"></span>
          <span class="sidebar-title">Catégories</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li class="{{ Route::currentRouteName() === 'categories.index' ? 'active' : '' }}">
            <a  href="/admin/categories/index">
              <span class="fa fa-desktop"></span>
              Index
            </a>
          </li>
          <li  class="{{ Route::currentRouteName() === 'categories.create' ? 'active' : '' }}">
            <a  href="/admin/categories/create">
              <span class="fa fa-plus"></span>
              Create
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'work') === 0 ? 'menu-open' : '' }}" href="#">
          <span class="fa fa-film"></span>
          <span class="sidebar-title">Work</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li class="{{ Route::currentRouteName() === 'work.index' ? 'active' : '' }}">
            <a  href="/admin/work/index">
              <span class="fa fa-desktop"></span>
              Index
            </a>
          </li>
          <li class="{{ Route::currentRouteName() === 'work.create' ? 'active' : '' }}">
            <a  href="/admin/work/create">
              <span class="fa fa-plus"></span>
              Create
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'photos') === 0 ? 'menu-open' : '' }}" href="#">
          <span class="fa fa-camera"></span>
          <span class="sidebar-title">Photos</span>
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li class="{{ Route::currentRouteName() === 'photos.index' ? 'active' : '' }}">
            <a  href="/admin/photos/index">
              <span class="fa fa-desktop"></span>
              Index
            </a>
          </li>
          <li class="{{ Route::currentRouteName() === 'photos.create' ? 'active' : '' }}">
            <a  href="/admin/photos/create">
              <span class="fa fa-plus"></span>
              Create
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle {{ strpos(Route::currentRouteName(), 'images') === 0 ? 'menu-open' : '' }}" href="#">
          <span class="fa fa-picture-o"></span>
          <span class="sidebar-title">Images</span>
          <span class="caret"></span>
        </a>
        <ul class="nav subnav">
          <li  class="{{ Route::currentRouteName() === 'images.index' ? 'active' : '' }}">
            <a  href="/admin/images/index">
              <span class="fa fa-desktop"></span>
              <span class="sidebar-title">Index</span>
            </a>
          </li>
          <li  class="{{ Route::currentRouteName() === 'images.create' ? 'active' : '' }}">
            <a  href="/admin/images/create">
              <span class="fa fa-plus"></span>
              Create
            </a>
          </li>
        </ul>
      </li>
    </ul>


  </div>
  <!-- End: Sidebar Left Content -->

</aside> --}}
