
<div class="overflow-x-auto">
    <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
        <tr>
            <th>Action</th>
            <th>Sujet</th>
            <th>Utilisateurs</th>
            <th>Créé par</th>
            <th>Créé le</th>
            <th>Mis à jour le</th>
        </tr>
        </thead>
        <tbody>
        @foreach($forums as $forum)
            <tr>
                <td>
                    <a href="{{ route('forum.showChannel', $forum) }}" class="btn btn-primary">Rejoindre</a>
                    @if($forum->users()->where('user_id', auth()->id())->exists())
                        <form action="{{ route('forum.quitChannel', $forum) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Quitter</button>
                        </form>
                    @endif
                </td>
                <td>
                    <a href="{{ route('forum.showChannel', $forum) }}">{{ $forum->title }}</a>
                </td>
                <td>
                    {{ $forum->users()->count() }}/{{ $forum->max_users }}
                </td>
                <td>
                    {{ $forum->user->name }}
                </td>
                <td>
                    {{ $forum->created_at->diffForHumans() }}
                </td>
                <td>
                    {{ $forum->updated_at->diffForHumans() }}
                </td>
            </tr>
        @endforeach
        </tbody>
        @if($forums->count() === 0)
            <tfoot>
            <tr>
                <td colspan="6" class="text-center">
                    Aucun sujet trouvé
                </td>
            </tr>
            </tfoot>
        @endif

        @if($forums->hasPages())
            <tfoot>
            <tr>
                <td colspan="6" class="text-center">
                    {{ $forums->links() }}
                </td>
            </tr>
            </tfoot>
        @endif
    </table>
</div>

