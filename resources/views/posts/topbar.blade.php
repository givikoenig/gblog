<div class="top-bar gray-bg visible-md visible-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="top-link pull-left">
                   <li><i class="fa fa-envelope"></i> {{ config('mail.from.address') }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <nav id="primary_nav_wrap">
                    <ul class="pull-right text-uppercase">
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Вход</a></li>
                        <li class="menu-divider"> / </li>
                        <li><a href="{{ route('register') }}">Регистрация</a></li>
                        @else
                        <li><a href="#">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></a>
                            <ul>
                                <li>
                                    @role('Admin')
                                        <a href="{{ url('/users') }}"><i class="fa fa-btn fa-users"></i>&nbsp;&nbsp;Пользователи</a>
                                    @endrole
                                    @can('Create Post')
                                        <a href="{{ route('posts.create') }}"><i class="fa fa-btn fa-file"></i>&nbsp;&nbsp;&nbsp;Добавить статью</a>
                                    @endcan
                                    <a href="{{ route('home') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>