<x-guest-layout>
    <!-- Show the moto article -->
    <div class="container mx-auto">
        <div class="flex items-center">
            <x-application-logo class="w-20 h-20 fill-current" />
            <h2 class="text-2xl ml-1 font-bold uppercase">{{ $motorbike->category()->first()->name }}</h2>
        </div>

        <div class="flex flex-col lg:flex-row">
            <div class="w-2/3">
                <img src="{{ asset('storage/'.$motorbike->image) }}" alt="{{ $motorbike->name }}" class="w-full">
            </div>
            <div class="divider lg:divider-horizontal">OR</div>
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


        @if($relatedMotorbikes->count() > 0)
            <div class="mt-10">
                <div class="divider"><h3 class="text-3xl font-bold">Vous aimerez aussi</h3></div>
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
