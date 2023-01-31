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
                    <input type="text" class="input bg-neutral" placeholder="Rechercher un conseiller" name="search" value="{{ request('search') }}">
                </div>
                <div class="form-control w-52">
                    <label class="cursor-pointer label">
                        <span class="label-text">Déjà contacté</span>
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
                    <th>Actions</th>
                    <th>Conseillers</th>
                    <th>Disponible</th>
                </tr>
                </thead>
                <tbody>
                @foreach($consultants as $consultant)
                    <tr>
                        <td>
                            @if($consultant->communications()->where('sender_id', auth()->user()->id)->where('accepted', true)->exists())
                                <a href="{{ route('communication.show', $consultant->communications()->where('sender_id', auth()->user()->id)->where('accepted', true)->first()) }}" class="btn btn-secondary">Reprendre</a>
                            @elseif($consultant->communications()->where('sender_id', auth()->user()->id)->where('accepted', false)->exists())
                                <a href="#" class="btn btn-primary" disabled>En attente ou Refusée</a>
                            @else
                                <form action="{{ route('communication.sendRequest', $consultant) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Contacter</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <div class="flex flex-row">
                                <div class="avatar">
                                    <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ asset("/storage/".$consultant->avatar) }}" alt="avatar"/>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="font-bold">{{ $consultant->name }}</p>
                                    <p class="text-primary">{{ $consultant->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-primary">Oui</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($consultants->count() === 0)
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-center">
                            Aucun consultant disponible pour le moment
                        </td>
                    </tr>
                    </tfoot>
                @endif

                @if($consultants->hasPages())
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-center">
                            {{ $consultants->links() }}
                        </td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>


    </div>
</x-app-layout>
