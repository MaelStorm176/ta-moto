<x-app-layout>

    <!-- retour aux forums -->
    <div class="flex justify-start p-4">
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="{{ route('shop.showCategory', $motorbike->category()->first()->id) }}">{{ $motorbike->category()->first()->name }}</a></li>
                <li><a href="{{ route('shop.show', $motorbike->id) }}">{{ $motorbike->name }}</a></li>
            </ul>
        </div>
    </div>

    <!-- Show the moto article -->
    <div class="container mx-auto">
        <div class="flex items-center">
            <x-application-logo class="w-20 h-20 fill-current" />
            <h2 class="text-2xl ml-1 font-bold uppercase">{{ $motorbike->category()->first()->name }}</h2>
        </div>

        <div class="flex flex-col lg:flex-row">
            <div class="w-2/3">
                <img src="{{ asset('storage/'.$motorbike->image) }}" alt="{{ $motorbike->name }}" class="w-full rounded">
            </div>
            <div class="divider lg:divider-horizontal"></div>
            <div class="p-3 flex flex-col justify-between">
                <h1 class="text-5xl font-bold">{{ $motorbike->name }}</h1>
                <p class="text-xl">{{ $motorbike->description }}</p>
                <div class="flex justify-around items-center">
                    <p class="text-2xl font-bold">A partir de {{ $motorbike->price }} €</p>
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="moto_id" value="{{ $motorbike->id }}">
                        <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-3">
        <h2 class="text-2xl font-bold uppercase p-3">Informations supplémentaires</h2>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Année</th>
                    <th>Carburant</th>
                    <th>Cylindrée</th>
                    <th>Puissance</th>
                    <th>Poids</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $motorbike->year }}</td>
                    <td>{{ trans($motorbike->fuel) }}</td>
                    <td>{{ $motorbike->cylinder }} cm3</td>
                    <td>{{ $motorbike->power }} ch</td>
                    <td>10kg</td>
                </tr>
            </tbody>
        </table>
    </div>


    @if($relatedMotorbikes->count() > 0)
        <div class="bg-base-300/50 p-3">
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold uppercase p-3">Vous aimerez aussi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($relatedMotorbikes as $moto)
                        <x-moto.moto-card :moto="$moto" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
