<x-app-layout>
    <div class="flex items-center min-h-screen justify-center">
        <div class="w-1/2">
            <x-auth-card>
                <x-slot name="logo">
                    <a href="{{ route('home') }}" class="card-title">
                        <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                        Nous contacter
                    </a>
                    <div class="divider"></div>
                </x-slot>

                <form method="POST" action="{{ route('contact') }}">
                    @csrf

                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4">
                        <!-- Email Address -->
                        <div class="form-control">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input
                                id="email"
                                class="mt-1 max-w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required autofocus
                                placeholder="Votre email"
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="form-control">
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input
                                id="name"
                                class="mt-1 max-w-full"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required autofocus
                                placeholder="Votre Nom/Prenom"
                            />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="form-control">
                        <x-input-label for="message" :value="__('Message')" />

                        <textarea
                            id="message"
                            class="textarea textarea-bordered"
                            name="message"
                            placeholder="Votre message"
                            rows="3"
                            required autofocus
                        >
                        </textarea>

                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>


                    <div class="card-actions justify-end self-end items-center mt-4">
                        <x-primary-button class="ml-3" type="submit">
                            Envoyer
                        </x-primary-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>
</x-app-layout>
