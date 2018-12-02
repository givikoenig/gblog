<header class="l-header">
    <div class="l-navbar l-navbar_compact l-navbar_t-dark js-navbar-sticky" id="app">
        <div class="container">
            <nav class="menuzord js-primary-navigation" role="navigation" aria-label="Primary Navigation">
                <!--logo start-->
                <div class="logo-wrap">
                <a href="{{ route('home') }}" class="logo-brand" >
                    <img class="retina" src="{{ asset('assets/img/logo-dark.png') }}" alt="GiViK">
                </a>
                <div class="logo-sign">
                    IT:SYS:WEB:PRO v.1.0
                </div>
                </div>
                <!--logo end-->
                <!--mega menu start-->
                <ul class="menuzord-menu menuzord-right c-nav_s-standard">
                    @if( null !==  Route::current()  &&  !(Route::current()->getName() == 'home') ) 
                    <li><a href="{{ route('home') }}" title="Главная"><i class="fa fa-btn fa-home"></i></a></li>
                        <li class="nav-divider" aria-hidden="true"><a href="javascript:void(0)">|</a></li>
                    @endif
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Вход</a></li>
                        <li class="nav-divider" aria-hidden="true"><a href="javascript:void(0)">|</a></li>
                        <li><a href="{{ route('register') }}">Регистрация</a></li>
                        @else
                        <li><a href="#">{{ Auth::user()->name }} {{-- <i class="fa fa-angle-down"></i> --}}</a>
                            <ul class="dropdown">
                                @role('Admin')
                                    <li>
                                        <a href="{{ url('/users') }}"><i class="fa fa-btn fa-users"></i>&nbsp;&nbsp;Пользователи</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin') }}" target="_blank"><i class="fa fa-btn fa-adn"></i>&nbsp;&nbsp;Админка</a>
                                    </li>
                                @endrole
                                <li>
                                    <a href="{{ route('profile') }}"><i class="fa fa-btn fa-user"></i>&nbsp;&nbsp;
                                    Профиль</a>
                                </li>
                                <li>
                                    <a href="{{ route('chat') }}"><i class="fa fa-btn fa-comments"></i>&nbsp;&nbsp;
                                    Чат</a>
                                </li>
                                <li>
                                    <a href="javascript: void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-sign-out"></i>&nbsp;&nbsp;
                                        Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-divider" aria-hidden="true"><a href="javascript:void(0)">|</a></li>
                        <headersearch-component></headersearch-component>
                    <li class="nav-divider" aria-hidden="true"><a href="javascript:void(0)">|</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-btn fa-wrench"></i></a>
                        <ul class="dropdown">
                            <li><a href="#IPCalcModal" data-toggle="modal"><i class="fa fa-btn fa-calculator"></i>&nbsp;&nbsp;IP Калькулятор</a></li>
                            <li><a href="#ColorPickerModal" data-toggle="modal"><i class="fa fa-btn fa-eyedropper"></i>&nbsp;&nbsp;Селектор цвета</a></li>
                        </ul>
                    </li>
                    <li class="nav-divider" aria-hidden="true"><a href="javascript:void(0)">|</a></li>
                    <li><a href="{{ route('player') }}"><i class="fa fa-btn fa-play"></i> HLS</a></li>
                </ul>
                <!--mega menu end-->
            </nav>
        </div>
    </div>
</header>
