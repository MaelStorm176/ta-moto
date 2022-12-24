<div class="card group">
    <figure>
        <a href="{{ route('shop.show',$moto) }}">
            <img src="{{ asset('storage/'.$moto->image) }}" alt="{{ $moto->name }}" class="card-image">
        </a>
    </figure>
    <div class="card-body">
        <h2 class="card-title">{{ $moto->name }} <div class="badge badge-primary uppercase">{{ $moto->category->name }}</div> </h2>
        <p class="card-subtitle">{{ $moto->description }}</p>
        <div class="card-actions justify-end">

        </div>
    </div>

    <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine"></div>
</div>
