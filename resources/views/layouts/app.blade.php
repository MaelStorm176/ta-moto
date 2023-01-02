<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="halloween">
    <x-layout.header />
    <body class="font-sans antialiased">
        <header>
            <x-navbar.navbar>
                <x-slot:start>
                    <x-navbar.dropdown>
                        <x-navbar.item url="{{ route('home') }}" label="Accueil" />
                        @auth
                            @can('browse_admin')
                                <x-navbar.item url="{{ route('voyager.login') }}" label="Administration" />
                            @endcan
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-navbar.item :url="route('logout')" label="{{ __('Log Out') }}" onclick="event.preventDefault();this.closest('form').submit();" />
                            </form>
                            <x-navbar.item url="{{ route('forum.index') }}" label="Le Forum" />
                        @endauth
                        @guest
                            <x-navbar.item url="{{ route('login') }}" label="Connexion" />
                            <x-navbar.item url="{{ route('register') }}" label="Inscription" />
                        @endguest
                    </x-navbar.dropdown>
                </x-slot:start>

                <x-slot:center>
                    <x-application-logo class="w-20 h-20 fill-current" />
                    <a class="btn btn-ghost normal-case text-xl" href="{{ route('home') }}">Ta moto</a>
                </x-slot:center>

                <x-slot:end>
                    <button class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    <button class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                    </button>
                </x-slot:end>
            </x-navbar.navbar>

            <x-navbar.alert>
                <p>Livraison gratuite à partir de 2 500€ d'achat
                    <a class="link-primary">Plus de détails</a>
                </p>
            </x-navbar.alert>
        </header>

        <main class="font-sans antialiased">
            {{ $slot }}
        </main>

    </body>
    <x-layout.footer />
</html>
