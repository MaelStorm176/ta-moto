<x-app-layout>

    <!-- retour aux forums -->
    <div class="flex justify-start p-4">
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="{{ route('forum.index') }}">Forum</a></li>
                <li><a href="{{ route('forum.showChannel', $channel->id) }}">{{ $channel->title }}</a></li>
            </ul>
        </div>
    </div>

    <div class="flex items-center min-h-screen justify-center">
        <x-auth-card>
            <x-slot name="logo">
                <a href="{{ route('forum.index') }}" class="card-title">
                    <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                    {{ $channel->title }}
                </a>
                <!-- Number of users online -->
                <div
                    class="text-sm text-gray-500"
                    x-data="{ users: [] }"
                    @channel-user-init.window="users = $event.detail"
                    @channel-user-joined.window="users.push($event.detail)"
                    @channel-user-left.window="users = users.filter(user => user.id !== $event.detail.id)"
                >
                    <span x-text="users.length"></span>/{{ $channel->max_users }} utilisateurs connectés
                </div>
            </x-slot>

            <div id="messages" class="h-full max-h-[375px] max-w-3xl overflow-y-scroll flex-wrap scrollbar scrollbar-thumb-primary scrollbar-track-neutral scrollbar-thin">
            @foreach($channel->messages as $message)
                <div class="chat chat-start bg-neutral ">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img src="{{ asset("storage/".$message->user->avatar) }}" alt="profile_picture"/>
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

            <div class="card-actions">
                <form action="{{ route('forum.addMessage',[$channel]) }}" method="post" class="flex w-full place-items-end">
                    @csrf
                    <div class="form-control w-[20rem]">
                        <x-input-label for="message" :value="__('Message')" />
                        <x-text-input id="message" class="block mt-1 max-w-xl" type="text" name="message" :value="old('message')" required autofocus />
                    </div>
                    <x-primary-button class="ml-3" type="submit">
                        Envoyer
                    </x-primary-button>
                </form>
            </div>
        </x-auth-card>
    </div>

    @section('scripts')
        @vite('resources/js/forum/showChannel.js')
    @endsection
</x-app-layout>
