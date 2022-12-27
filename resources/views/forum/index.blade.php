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

    <div class="container mx-auto">
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
                            <a href="{{ route('forum.showChannel', $forum) }}" class="btn btn-primary">Voir</a>
                        </td>
                        <td>
                            <a href="{{ route('forum.showChannel', $forum) }}">{{ $forum->title }}</a>
                        </td>
                        <td>
                            4/{{ $forum->max_users }}
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
            </table>
        </div>
    </div>
</x-app-layout>
