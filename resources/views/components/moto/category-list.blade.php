<div class="navbar text-neutral-content justify-center">
    @foreach($categories as $category)
        <x-moto.category-link :category="$category" />
    @endforeach
</div>
