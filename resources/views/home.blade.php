<x-guest-layout>

    <!-- HERO -->
    <div class="hero bg-base-300/100 p-3">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/short-hero/low-rider-el-diablo-homepage-short-hero.jpg?impolicy=myresize&rw=1060"
                class="max-w-3xl rounded-lg shadow-2xl"
                alt="nouvelle moto"
            />
            <div>
                <h3 class="text-4xl font-bold">Low Rider™ El Diablo 2022</h3>
                <p class="py-6">Dernier ajout à la collection Icons, le Low Rider El Diablo 2022 est une interprétation moderne de l’emblématique Harley-Davidson FXRT de 1983 et une représentation du mouvement custom que le modèle a initié.</p>
                <button class="btn btn-primary uppercase">
                    Voir la moto
                    <x-fas-arrow-right class="w-4 h-4 ml-2" />
                </button>
            </div>
        </div>
    </div>

    <div class="p-5">
        <x-moto.category-list :categories="$categories" />
    </div>
    <!-- SECOND HERO -->
    <div class="hero p-3">
        <div class="hero-content flex-col lg:flex-row">
            <img src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/media-card/apex-homepage-sept-launch-media-card.jpg?impolicy=myresize&rw=800" class="max-w-xl rounded-lg shadow-2xl"  alt=""/>
            <div>
                <h3 class="text-4xl font-bold">PEINTURE CUSTOM D’USINE APEX</h3>
                <p class="py-6">Inspirée par la peinture et les motifs des motos de course de toute notre histoire, la peinture custom d’usine Apex rend hommage  à la tradition de victoires de Harley-Davidson avec des motifs et des couleurs proposés sur une sélection de motos Grand American Touring 2022.</p>
                <button class="btn btn-primary uppercase">
                    Découvrer les peintures
                    <x-fas-arrow-right class="w-4 h-4 ml-2" />
                </button>
            </div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="bg-base-300/50 p-3">
        <div class="container mx-auto">

            <div class="flex justify-start p-4">
                <h3 class="text-4xl font-bold">Trouvez votre prochaine balade</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($motos as $moto)
                    <x-moto.moto-card :moto="$moto" />
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
