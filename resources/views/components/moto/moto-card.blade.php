<div class="card">
    <figure>
        <img src="{{ asset('storage/'.$moto->image) }}" alt="{{ $moto->name }}"/>
    </figure>
    <div class="card-body">
        <h2 class="card-title">{{ $moto->name }}</h2>
        <p class="card-subtitle">
            {{ $moto->description }}
        </p>
    </div>
</div>
