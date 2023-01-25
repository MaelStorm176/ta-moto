<x-app-layout>
    <div class="min-h-screen">
        <div class="container mx-auto p-3">
            <div class="flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
                <h2 class="text-2xl ml-1 font-bold uppercase">Mon Profil</h2>
                @if(Auth::user()->role()->first()->name === 'admin')
                    <span class="badge badge-primary mx-3">Administrateur</span>
                @endif
            </div>

            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" role="form" >
                @csrf
                <div class="grid md:grid-cols-2 gap-20 sm:grid-cols-1 mb-5">
                    <div class="flex flex-col justify-between">
                        <div class="form-control w-full">
                            <label class="label" for="username">
                                <span class="label-text">Nom</span>
                            </label>
                            <input value="{{ Auth::user()->name }}" name="username" id="username" type="text" placeholder="Votre nom d'utilisateur" class="input input-bordered w-full" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="email">
                                <span class="label-text">Adresse Email</span>
                            </label>
                            <input value="{{ Auth::user()->email }}" name="email" id="email" type="text" placeholder="Votre adresse email" class="input input-bordered w-full" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="password">
                                <span class="label-text">Mot de passe</span>
                                <span class="label-text-alt">Laissez vide pour ne pas changer</span>
                            </label>
                            <input name="password" id="password" type="text" placeholder="Votre mot de passe" class="input input-bordered w-full" />
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 float-right">Enregistrer</button>
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        <div class="avatar">
                            <div class="w-64 rounded-full">
                                <img src="{{ asset('storage/'.Auth::user()->getAttribute('avatar')) }}" alt="avatar" class="w-64 h-64 rounded-full mx-auto">
                            </div>
                        </div>
                        <div class="form-control w-full">
                            <label class="label" for="avatar">
                                <span class="label-text">Avatar</span>
                            </label>
                            <input name="avatar" id="avatar" type="file" placeholder="Type here" class="file-input file-input-bordered w-full" />
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-base-300/50 p-3">
            <div class="container mx-auto mb-5">
                <div class="flex justify-start p-4">
                    <h3 class="text-4xl font-bold">Mes Forums</h3>
                </div>
                <x-forum.forum-table :forums="$forums" />
            </div>
        </div>

    </div>
</x-app-layout>
