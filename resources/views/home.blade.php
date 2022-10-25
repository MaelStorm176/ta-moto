<x-guest-layout>

    <!-- HERO -->
    <div class="hero bg-base-300/100">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/short-hero/low-rider-el-diablo-homepage-short-hero.jpg?impolicy=myresize&rw=1060"
                class="max-w-lg rounded-lg shadow-2xl"
                alt="nouvelle moto"
            />
            <div>
                <h1 class="text-5xl font-bold">Low Rider™ El Diablo 2022</h1>
                <p class="py-6">Dernier ajout à la collection Icons, le Low Rider El Diablo 2022 est une interprétation moderne de l’emblématique Harley-Davidson FXRT de 1983 et une représentation du mouvement custom que le modèle a initié.</p>
                <button class="btn btn-primary uppercase">
                    Voir la moto
                    <x-fas-arrow-right class="w-4 h-4 ml-2" />
                </button>
            </div>
        </div>
    </div>

    <div class="p-5">
        <div class="navbar text-neutral-content justify-center">
            <a class="btn btn-ghost uppercase text-xl">Sport</a>
            <a class="btn btn-ghost uppercase text-xl">Cruiser</a>
            <a class="btn btn-ghost uppercase text-xl">Grand American Touring</a>
            <a class="btn btn-ghost uppercase text-xl">Adventure touring</a>
            <a class="btn btn-ghost uppercase text-xl">Trike</a>
        </div>
    </div>
    <!-- SECOND HERO -->
    <div class="hero bg-base-100">
        <div class="hero-content flex-col lg:flex-row">
            <img src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/media-card/apex-homepage-sept-launch-media-card.jpg?impolicy=myresize&rw=800" class="max-w-sm rounded-lg shadow-2xl"  alt=""/>
            <div>
                <h1 class="text-5xl font-bold">PEINTURE CUSTOM D’USINE APEX</h1>
                <p class="py-6">Inspirée par la peinture et les motifs des motos de course de toute notre histoire, la peinture custom d’usine Apex rend hommage  à la tradition de victoires de Harley-Davidson avec des motifs et des couleurs proposés sur une sélection de motos Grand American Touring 2022.</p>
                <button class="btn btn-primary uppercase">
                    Découvrer les peintures
                    <x-fas-arrow-right class="w-4 h-4 ml-2" />
                </button>
            </div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card">
                <figure>
                    <img src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/1x1/ultra-limited-hero-card-3-up.jpg?impolicy=myresize&rw=650" alt="nouvelle moto" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Ultra limited</h2>
                    <p class="card-subtitle">
                        Pour une expérience touring optimale, la 2022 Ultra Limited arbore un style audacieux et offre des performances de pointe sans aucun compromis sur la conduite.
                    </p>
                </div>
            </div>
            <div class="card">
                <figure>
                    <img src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/1x1/street-bob-22-hero-card.jpg?impolicy=myresize&rw=650" alt="nouvelle moto" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Street bob 114</h2>
                    <p class="card-subtitle">
                        Un Bobber brut et épuré, tout de noir vêtu.La 2022 Street Bob 114 offre une toile parfaite pour la customisation.
                    </p>
                </div>
            </div>
            <div class="card">
                <figure>
                    <img src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/1x1/nightster-hero-card-3-up.jpg?impolicy=myresize&rw=650" alt="nouvelle moto" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Nightster</h2>
                    <p class="card-subtitle">
                        Nouveauté de 2022, la Nightster est une machine née d’une icône d’hier améliorée pour les pilotes d’aujourd’hui. Elle associe la silhouette classique de la Sportster à la puissance du moteur Revolution Max.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
