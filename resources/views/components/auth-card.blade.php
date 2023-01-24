@props(['image'])
<div class="card bg-neutral text-neutral-content lg:card-side shadow-xl">
    @if($image)
        <figure class="h-full">
            <img src="{{ $image }}" alt="Cover" class="w-[500px] object-cover">
        </figure>
    @endif
    <div class="card-body">
        {{ $logo }}
        {{ $slot }}
    </div>
</div>
