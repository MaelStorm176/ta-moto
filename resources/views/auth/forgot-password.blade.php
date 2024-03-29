<x-app-layout>
    <div class="flex items-center min-h-screen justify-center">
        <x-auth-card image="{{ asset('card_images/ricardo-arce-YBdFPom4ylM-unsplash.jpg') }}">
            <x-slot name="logo">
                <a href="{{ route('home') }}" class="card-title">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    Mot de passe oublié
                </a>
                <div class="divider"></div>
            </x-slot>

            <div class="mb-4 text-sm text-gray-600" style="max-width: 400px">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email associé à votre compte" :value="old('email')" required autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 ">
                    <x-primary-button class="w-full">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </x-auth-card>
    </div>
</x-app-layout>
