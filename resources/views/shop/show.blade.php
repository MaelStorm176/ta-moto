<x-guest-layout>
    <!-- Show the moto article -->
    <div class="container mx-auto">
        <div class="flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('storage/'.$motorbike->image) }}" alt="{{ $motorbike->name }}" class="w-full">
            </div>
            <div class="w-full lg:w-1/2 p-3">
                <h1 class="text-5xl font-bold">{{ $motorbike->name }}</h1>
                <p class="text-xl">{{ $motorbike->description }}</p>
                <p class="text-2xl font-bold">{{ $motorbike->price }}€</p>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="moto_id" value="{{ $motorbike->id }}">
                    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                </form>
            </div>
        </div>


        @if($relatedMotorbikes->count() > 0)
            <div class="mt-10">
                <div class="divider"><h2 class="text-3xl font-bold">Vous aimerez aussi</h2></div>
                <div class="flex flex-wrap">
                    @foreach ($relatedMotorbikes as $moto)
                        <div class="w-full lg:w-1/3 p-3">
                            <x-moto.moto-card :moto="$moto" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>
