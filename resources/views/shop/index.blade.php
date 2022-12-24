<x-guest-layout>
    <div class="hero" style="background-image: url(https://www.harley-davidson.com/content/dam/h-d/images/category-images/2022/short-hero/2022-sport-category-short-hero-image.jpg?impolicy=myresize&rw=1060);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Trouve Ta Moto !</h1>
                <p class="mb-5">L’aventure commence au guidon d’une Harley-Davidson®. Vivez des week-ends héroïques. Partez au travail en lâchant l’adrénaline. Une Harley-Davidson® vous ouvre de nouveaux horizons. La liberté pure. Aussi vastes et réels que dans vos rêves. La liberté pure.</p>
            </div>
        </div>
    </div>

    <div class="p-5">
        <x-moto.category-list :categories="$categories" />
    </div>


    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($motorbikes as $moto)
                <x-moto.moto-card :moto="$moto" />
            @endforeach
        </div>
    </div>
</x-guest-layout>
