<x-app-layout>

    <div class="hero" style="background-image: url({{ asset('other_images/my23-reveal-120-tall-hero-desktop.webp') }});">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Ta Moto !</h1>
                <p class="mb-5">Une aventure unique partagée avec vous depuis 1922 !</p>
            </div>
        </div>
    </div>

    <div class="bg-base-300/50 p-3">
        <div class="container mx-auto p-5">
            <div class="flex justify-center p-4">
                <h3 class="text-4xl font-bold">Qui sommes-nous ?</h3>
            </div>
            <p class="text-center">
                En 1920, dans un petit hangar de Milwaukee, dans le Wisconsin, quatre jeunes hommes ont allumé un feu de forêt culturel qui allait se développer et se propager à travers les pays et les générations. Leur innovation et leur imagination quant à ce qui était possible sur deux roues ont déclenché une révolution du transport et un style de vie qui ont fait de Harley-Davidson la marque de motos et de style de vie la plus appréciée au monde. Aujourd'hui, nous continuons à définir la culture et le style de vie de la moto, en évoquant l'émotion de l'âme qui se reflète dans chaque produit et chaque expérience que nous offrons - comme nous l'avons fait pendant plus d'un siècle et comme nous le ferons pour les générations à venir.
            </p>
        </div>
    </div>

    <div class="p-5">
        <div class="navbar text-neutral-content justify-center">
            <a class="btn btn-ghost uppercase text-xl" href="#mission">
                Notre mission
            </a>
            <a class="btn btn-ghost uppercase text-xl" href="#valeur">
                Nos valeurs
            </a>
            <a class="btn btn-ghost uppercase text-xl" href="#ambition">
                Notre ambition
            </a>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero bg-base-300/100 p-3">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="https://www.harley-davidson.com/content/dam/h-d/images/promo-images/2022/short-hero/low-rider-el-diablo-homepage-short-hero.jpg?impolicy=myresize&rw=1060"
                class="max-w-3xl rounded-lg shadow-2xl"
                alt="mission"
            />
            <div>
                <div class="flex justify-center p-4">
                    <h3 class="text-4xl font-bold" id="mission">Notre mission</h3>
                </div>
                <p class="text-center">
                    Nous sommes une entreprise de passionnés qui a pour mission de créer des expériences de vie exceptionnelles pour nos clients, nos employés et nos partenaires.
                </p>
            </div>
        </div>
    </div>


    <!-- HERO -->
    <div class="hero bg-base-300/100 p-3">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div>
                <div class="flex justify-center p-4">
                    <h3 class="text-4xl font-bold" id="valeur">Nos valeurs</h3>
                </div>
                <p class="text-center">
                    Nous croyons fermement que la moto est plus qu'un simple moyen de transport, c'est une passion qui nous unit tous. C'est pourquoi nous nous efforçons de fournir des produits de qualité supérieure qui répondent aux besoins et aux attentes de nos clients. Nous croyons en l'importance de respecter l'environnement et de promouvoir des modes de transport durables, c'est pourquoi nous proposons une gamme de motos équipées de moteurs écologiques. La sécurité des pilotes et des passagers est notre priorité absolue, et nous travaillons sans relâche pour assurer que chaque moto que nous vendons répond aux normes les plus élevées en matière de sécurité.
                </p>
            </div>
            <img
                src="{{ asset('other_images/my23-reveal-120-tall-hero-desktop.webp') }}"
                class="max-w-3xl rounded-lg shadow-2xl"
                alt="valeurs"
            />
        </div>
    </div>

    <div class="hero bg-base-300/100 p-3">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="{{ asset('other_images/2.jpeg') }}"
                class="max-w-3xl rounded-lg shadow-2xl"
                alt="ambition"
            />
            <div>
                <div class="flex justify-center p-4">
                    <h3 class="text-4xl font-bold" id="valeur">Notre ambition</h3>
                </div>
                <p class="text-center">
                    Nous sommes fiers de fournir un service client attentif et professionnel pour aider nos clients à trouver la moto de leurs rêves. Nous sommes convaincus que la moto offre une liberté et une aventure sans égal, et nous sommes fiers de promouvoir ce mode de vie. Alors si vous êtes passionné de motos comme nous le sommes, venez explorer notre gamme de produits et découvrir pourquoi nous sommes le choix idéal pour les amateurs de deux-roues.
                </p>
            </div>
        </div>
    </div>

</x-app-layout>
