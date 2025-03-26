<header class="flex flex-col justify-around gap-4 lg:flex-row  ">
    <div class="order-1">
        <a href="/"><img src="/images/toki_logo.webp" alt="Toki Verkkokirjasto - Lukuhaaste" /></a>
    </div>

    <x-search-bar />

    <nav class="order-2 lg:order-3">
        <x-nav-link :href="url('/')" :active="request()->routeIs('home')">
            {{ __('Etusivu') }}
        </x-nav-link>

        @if (Route::has('login'))
        @auth
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Kojelauta') }}
        </x-nav-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a :href="route('logout')"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">Kirjaudu ulos</a>
        </form>
        @else
        <x-nav-link :href="route('login')" :active="request()->routeIs('logout')">
            {{ __('Kirjaudu sisään') }}
        </x-nav-link>
        @endauth
        @endif

        <label for="theme-toggle" class="theme-toggle-label">
            <!-- FontAwesome Icon for Moon/Sun -->
            <i id="theme-icon" class="theme-icon"></i>
            <span id="theme-text">Light mode</span>
        </label>
    </nav>



</header>