<header class="p-header">
    <nav>
        <div class="nav-wrapper container">
            <a href="{{ url('/', null) }}" class="brand-logo">ドイツ語例題</a>
            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ url('/list', null) }}">問題一覧</a></li>
                @auth
                    <li>
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ url('/login', null) }}">ログイン</a></li>
                @endguest
            </ul>
        </div>
    </nav>

</header>
<ul class="sidenav" id="mobile-menu">
    <li><a href="{{ url('/list', null) }}">問題一覧</a></li>
    @auth
        <li>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endauth
    @guest
        <li><a href="{{ url('/login', null) }}">ログイン</a></li>
    @endguest
</ul>
<main>
