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
                            <x-navbar.item url="{{ route('profile') }}" label="Mon profil" />
                            @can('browse_admin')
                                <x-navbar.item url="{{ route('voyager.login') }}" label="Administration" />
                            @endcan
                            <x-navbar.item url="{{ route('forum.index') }}" label="Le Forum" />
                            <x-navbar.item url="{{ route('communication.index') }}" label="Conseillers et Utilisateurs" />
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-navbar.item
                                    class="bg-error"
                                    :url="route('logout')"
                                    label="{{ __('Log Out') }}"
                                    onclick="event.preventDefault();this.closest('form').submit();"
                                />
                            </form>
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

                    @auth
                    <div
                        class="dropdown dropdown-end"
                        x-data="{ notifications: [] }"
                        @notification-received.window="
                            if (notifications.find(notification => notification.id === $event.detail.id)) {
                                return;
                            }
                            notifications.push($event.detail);
                        "
                        @notification-read.window="
                            notifications = notifications.filter(notification => notification.id !== $event.detail.id);
                        "
                    >
                        <button class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                                <span class="badge badge-xs badge-primary indicator-item" x-text="notifications.length"></span>
                            </div>
                        </button>
                        <ul
                            tabindex="0"
                            class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 text-base-content max-h-[30rem] overflow-y-auto"
                        >
                            <template x-if="notifications.length > 0" x-for="notification in notifications">
                                <li>
                                    <a
                                        x-text="notification.title"
                                        @click="$dispatch('toggle-modal-notification', notification)"
                                    >
                                    </a>
                                </li>
                            </template>

                            <template x-if="notifications.length === 0">
                                <li class="flex items-center">Aucune notification</li>
                            </template>
                        </ul>
                    </div>
                    @endauth
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


        <div
            x-data="chatbot"
            class="m-5 fixed bottom-0 right-0 z-50">
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    id="bot-container"
                    class="bg-neutral"
                >
                    <div id="bot-header" class="flex items-center justify-between">

                        <div id="bot-header-img">
                            <div class="avatar cursor-pointer rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <div class="w-10 rounded-full">
                                    <img src="{{ asset('chatbot-icon.svg') }}" alt="chatbot"/>
                                </div>
                            </div>
                        </div>

                        <div id="bot-header-title">
                            <h3 class="text-lg font-bold">Chatbot</h3>
                            <div id="bot-header-title-text">
                                <span id="bot-header-title-text-status">En ligne</span>
                            </div>
                        </div>

                        <button class="btn btn-ghost btn-circle" @click="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="divider m-0"></div>

                    <div id="bot-inner" x-ref="bot">
                        <template x-for="chatbotMessage in chatbotMessages">
                            <div x-data="{ disabled: false }">
                                <div class="chat chat-start">
                                    <div class="chat-bubble chat-bubble-primary" x-text="chatbotMessage.message"></div>
                                </div>

                                <!-- PROPOSITIONS -->
                                <template x-if="chatbotMessage.type === 'select' && chatbotMessage.options">
                                    <div class="chat chat-end">
                                        <div class="chat-bubble flex flex-col justify-between justify-center items-center">
                                            <template x-for="proposition in chatbotMessage.options">
                                                <button
                                                    class="btn btn-secondary w-full my-2"
                                                    @click="goNext(proposition.next); disabled = true"
                                                    x-bind:disabled="disabled"
                                                >
                                                    <span x-text="proposition.label"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <!-- INPUT -->
                                <template x-if="chatbotMessage.type === 'input'">
                                    <div class="chat chat-end">
                                        <div
                                            class="chat-bubble flex flex-col justify-between justify-center items-center">
                                            <input
                                                class="input input-primary input-bordered w-full"
                                                type="text"
                                                x-model="query.input"
                                                x-bind:disabled="disabled"
                                                @keydown.enter="goNext(chatbotMessage.next); disabled = true"
                                            >
                                        </div>
                                    </div>
                                </template>

                            </div>
                        </template>

                    </div>
                </div>

                <div x-show="!open" x-transition:enter.delay.500ms>
                    <div class="avatar rounded-full ring ring-primary ring-offset-primary ring-offset-2 cursor-pointer" @click="open = true">
                        <div class="w-12 rounded-full">
                            <img src="{{ asset('chatbot-icon.svg') }}" alt="chatbot"/>
                        </div>
                    </div>
                </div>

            </div>

        @auth
        <!-- Put this part before </body> tag -->
        <div
            x-data="{ notification: null }"
            @toggle-modal-notification.window="notification = $event.detail;"
        >
            <template x-if="notification">
                <div class="modal modal-bottom sm:modal-middle modal-open" id="modal-notification">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg" x-text="notification.title"></h3>
                        <p class="py-4" x-text="notification.content"></p>
                        <div class="modal-action">
                            <a href="#" class="btn" @click="axios.post(`/notifications/${notification.id}/read`).then(r => {
                                dispatchEvent(new CustomEvent('notification-read', { detail: notification }));
                                notification = null;
                            }).catch(err => {
                                console.log(err);
                            })">Bien reçu !</a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        @endauth

        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-error shadow-lg absolute top-5 left-5 z-50 w-1/3">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $error }}</span>
                    </div>
                </div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success shadow-lg absolute top-5 left-5 z-50 w-1/3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

    </body>
    <x-layout.footer />
</html>
