<x-app-layout>
    <div class="hero" style="background-image: url(https://www.harley-davidson.com/content/dam/h-d/images/category-images/2022/short-hero/2022-sport-category-short-hero-image.jpg?impolicy=myresize&rw=1060);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Bienvenue sur le Forum !</h1>
                <p class="mb-5">Une question, une demande ? Vous trouverez ici les discussions de la communauté de Ta Moto...</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-10">

        <div class="flex justify-start p-4">
            <h3 class="text-4xl font-bold">Liste des sujets</h3>
        </div>

        <!-- Searchbar to filter the list of topics -->
        <div class="py-4">
            <form action="#" method="get" class="flex justify-start items-center justify-between">
                <div>
                    <input type="text" class="input bg-neutral" placeholder="Rechercher un sujet" name="search" value="{{ request('search') }}">
                </div>
                <div class="form-control w-52">
                    <label class="cursor-pointer label">
                        <span class="label-text">Deja rejoins</span>
                        <input type="checkbox" class="toggle toggle-primary" name="joined" id="joined" {{ request('joined') ? 'checked' : '' }}>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary ml-2">Rechercher</button>
            </form>
        </div>


        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                <tr>
                    <th>Action</th>
                    <th>Sujet</th>
                    <th>Utilisateurs</th>
                    <th>Créé par</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                </tr>
                </thead>
                <tbody>
                @foreach($forums as $forum)
                    <tr>
                        <td>
                            <a href="{{ route('forum.showChannel', $forum) }}" class="btn btn-primary">Rejoindre</a>
                        </td>
                        <td>
                            <a href="{{ route('forum.showChannel', $forum) }}">{{ $forum->title }}</a>
                        </td>
                        <td>
                            {{ $forum->users()->count() }}/{{ $forum->max_users }}
                        </td>
                        <td>
                            {{ $forum->user->name }}
                        </td>
                        <td>
                            {{ $forum->created_at->diffForHumans() }}
                        </td>
                        <td>
                            {{ $forum->updated_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($forums->count() === 0)
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-center">
                            Aucun sujet trouvé
                        </td>
                    </tr>
                    </tfoot>
                @endif

                @if($forums->hasPages())
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-center">
                            {{ $forums->links() }}
                        </td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</x-app-layout>
