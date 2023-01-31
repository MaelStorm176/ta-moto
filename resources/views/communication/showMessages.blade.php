<x-app-layout>

    <!-- retour aux forums -->
    <div class="flex justify-start p-4">
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="{{ route('communication.index') }}">Communications</a></li>
                <li><a href="{{ route('communication.show', $communication) }}">{{ $opposite_user->name }}</a></li>
            </ul>
        </div>
    </div>

    <!-- Liste des utilisateurs connectés sur le côté gauche de l'écran ou au milieu-->
    <div
        class="md:flex md:items-center min-h-screen sm:flex-col sm:justify-center sm:pt-6"
        x-data="{ users: [] }"
        @channel-user-init.window="users = $event.detail"
        @channel-user-joined.window="users.push($event.detail)"
        @channel-user-left.window="users = users.filter(user => user.id !== $event.detail.id)"
    >
        <div class="w-1/5 p-4">
            <ul class="menu bg-neutral rounded-box">
                <li class="menu-title flex flex-row justify-between p-2">
                    <span>Utilisateurs connectés</span>
                </li>
                <template
                    x-for="user in users"
                    :key="user.id"
                >
                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 space-x-2 rounded-box hover:bg-base-200"
                        >
                            <div class="avatar online">
                                <div class="w-10 rounded-full">
                                    <img :src="`/storage/${user.avatar}`" alt="profile_picture">
                                </div>
                            </div>

                            <span x-text="user.name"></span>
                            <template x-if="user.is_admin">
                                <span class="badge badge-primary justify-self-end">Admin</span>
                            </template>
                        </a>
                    </li>
                </template>
            </ul>
        </div>
        <x-auth-card image="{{ asset('card_images/verify-email.jpg') }}">
            <x-slot name="logo">
                <a href="{{ route('forum.index') }}" class="card-title">
                    <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                    {{ $opposite_user->name }}
                </a>
            </x-slot>
            <div
                id="messages"
                class="h-full max-h-[600px] max-w-3xl overflow-y-scroll flex-wrap scrollbar scrollbar-thumb-primary scrollbar-track-neutral scrollbar-thin"
                x-data="{{ Js::from(["messages" => $communication->messages]) }}"
                x-init="$nextTick(() => $el.scrollTo(0, $el.scrollHeight))"
                @channel-message-posted.window="
                    messages.push($event.detail);
                    $nextTick(() => $el.scrollTo(0, $el.scrollHeight));
                "

            >
                <template x-if="messages.length > 0">
                    <template
                        x-for="message in messages"
                        :key="message.id"
                    >
                        <div class="chat chat-start bg-neutral my-5">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img :src="`/storage/${message.sender.avatar}`" alt="profile_picture"/>
                                </div>
                            </div>
                            <div class="chat-header p-1">
                                <small class="text-gray-400" x-text="message.sender.name"></small>
                                <time class="text-xs opacity-50" :datetime="message.created_at" x-text="new Date(message.created_at).toLocaleString()"></time>
                            </div>
                            <div class="chat-bubble bg-primary-content/50" x-text="message.message"></div>
                        </div>
                    </template>
                </template>

            </div>

            <div class="card-actions">
                <form
                    action="#"
                    method="post"
                    class="flex w-full place-items-end"
                    x-data="messageForm"
                    @submit.prevent="submit"
                >
                    <div class="form-control w-[20rem]">
                        <x-input-label for="message" :value="__('Message')" />
                        <x-text-input x-model="data.message" id="message" class="block mt-1 max-w-xl" type="text" name="message" :value="old('message')" required autofocus />
                    </div>
                    <x-primary-button class="ml-3" type="submit">
                        Envoyer
                    </x-primary-button>
                </form>
            </div>
        </x-auth-card>
    </div>

    @section('scripts')
        @vite('resources/js/communication/showMessages.js')
    @endsection
</x-app-layout>
