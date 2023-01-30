<x-app-layout>
    <div class="hero" style="background-image: url({{ asset('other_images/icons-collection-low-rider-el-diablo-media-card.webp') }})">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Prenez contact avec nos conseillers !</h1>
                <p class="mb-5">Une question, une demande personnelle ? Vous pourrez ici communiquer en direct avec nos conseillers...</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-10">

        <div class="flex justify-start p-4">
            <h3 class="text-4xl font-bold">Conseillers disponibles</h3>
        </div>

        <!-- Searchbar to filter the list of topics -->
        <div class="py-4">
            <form action="#" method="get" class="flex justify-start items-center justify-between">
                <div>
                    <input type="text" class="input bg-neutral" placeholder="Rechercher un sujet" name="search" value="{{ request('search') }}">
                </div>
                <div class="form-control w-52">
                    <label class="cursor-pointer label">
                        <span class="label-text">Déjà rejoins</span>
                        <input type="checkbox" class="toggle toggle-primary" name="joined" id="joined" {{ request('joined') ? 'checked' : '' }}>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary ml-2">Rechercher</button>
            </form>
        </div>
    </div>
</x-app-layout>
