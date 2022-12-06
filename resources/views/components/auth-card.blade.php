<div class="card bg-neutral text-neutral-content lg:card-side shadow-xl">
    <figure><img src="https://placeimg.com/400/400/arch" alt="Album"/></figure>
    <div class="card-body">
        {{ $logo }}
        {{ $slot }}
        <div class="card-actions justify-end self-end">
            {{ $actions }}
        </div>
    </div>
</div>
