<x-app-layout>

    <div class="flex items-center min-h-screen justify-center">
        <x-auth-card>
            <x-slot name="logo">
                <a href="{{ route('forum.index') }}" class="card-title">
                    <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                    {{ $channel->title }}
                </a>
            </x-slot>

            <div class="h-full max-h-[375px] max-w-3xl overflow-y-scroll flex-wrap scrollbar scrollbar-thumb-primary scrollbar-track-neutral scrollbar-thin">
            @foreach($channel->messages as $message)
                <div class="chat chat-start bg-neutral ">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img src="https://placeimg.com/192/192/people" alt="profile_picture"/>
                        </div>
                    </div>
                    <div class="chat-header">
                        {{ $message->user->name }}
                        <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                    </div>
                    <div class="chat-bubble border border-primary rounded-bl">{{ $message->message }}</div>
                </div>
                <div class="divider"></div>
            @endforeach
            </div>

            <div class="card-actions place-items-end w-full">
                <div class="form-control w-[20rem]">
                    <x-input-label for="message" :value="__('Message')" />
                    <x-text-input id="message" class="block mt-1 max-w-xl" type="text" name="message" :value="old('message')" required autofocus />
                </div>
                <x-primary-button class="ml-3" type="submit">
                    Envoyer
                </x-primary-button>
            </div>

        </x-auth-card>
    </div>
</x-app-layout>
