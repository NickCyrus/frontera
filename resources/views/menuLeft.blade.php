<!-- Menu -->
 
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('home')}}" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">{{env('APP_NAME')}}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @php 
      $modulo = explode('.', Route::currentRouteName());
    @endphp
    <ul class="menu-inner py-1"> 
      @forelse(Auth::User()->getMenuLeft()  as $menu)
        <li class="menu-item @if($menu->urlapp == $modulo[0]) active @endif" > 
          <a href="{{route($menu->urlapp)}}" class="menu-link">
            <i class="menu-icon tf-icons bx {{$menu->iconapp ?? 'bx-menu' }}"></i>
            <div data-i18n="Layouts">{{$menu->nameapp}}</div>
          </a>
        </li>
      @empty
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link ">
          <div data-i18n="Layouts">Sin Opciones</div>
        </a>
      </li>
      @endforelse
    </ul>
     
    
  
  </aside>
  <!-- / Menu -->