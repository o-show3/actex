<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <x-navbar-item :href="route('dashboard')" :active="request()->routeIs('dashboard')" >
                    {{ __('Dashboard') }}
                </x-navbar-item>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        マッチング
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-dropdown">
                        <li><a class="dropdown-item" href="{{route('users.pair')}}">マッチ</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('category.top')}}">ハッシュタグ</a></li>
                        <li><a class="dropdown-item" href="{{route('topics.top')}}" >気になる話題</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                @auth
                {{--  ログインしている場合 --}}
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <input type="submit" class="btn btn-primary" value="{{ __('Logout') }}">
                </form>
                @endauth
                @guest
                {{--  ログインしていない場合 --}}
                <a class="btn btn-outline-success" href="{{route('register')}}">
                    {{ __('Sign up') }}
                </a>
                <a class="btn btn-outline-success" href="{{route('login')}}">
                    {{ __('Login') }}
                </a>
                @endguest
            </div>
        </div>
    </div>
</nav>
