<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarBasicExample " class="navbar-menu">
        <div class="navbar-start">
            <x-navbar-item :href="route('dashboard')" >
                {{ __('Dashboard') }}
            </x-navbar-item>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    マッチング
                </a>
                <div class="navbar-dropdown">
                    <x-navbar-item :href="route('users.pair')" >
                        マッチ
                    </x-navbar-item>
                    <hr class="navbar-divider">
                    <x-navbar-item :href="route('category.top')" >
                        ハッシュタグ
                    </x-navbar-item>
                    <x-navbar-item :href="route('topics.top')" >
                        気になる話題
                    </x-navbar-item>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @auth
                    {{-- ログインしている場合 --}}
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <input type="submit" class="button is-light" value="{{ __('Logout') }}">
                    </form>

                    @endauth
{{--                    @guest--}}
{{--                    --}}{{-- ログインしていない場合 --}}
{{--                    <a class="button is-primary" href="{{route('register')}}">--}}
{{--                        {{ __('Sign up') }}--}}
{{--                    </a>--}}
{{--                    <a class="button is-light" href="{{route('login')}}">--}}
{{--                        {{ __('Login') }}--}}
{{--                    </a>--}}
{{--                    @endguest--}}
                </div>
            </div>
        </div>
    </div>
</nav>
