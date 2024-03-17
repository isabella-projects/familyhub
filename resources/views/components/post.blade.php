<a href="/post/{{$post->id}}" class="d-flex align-items-center list-group-item p-3 list-group-item-action">
    <div class="col-auto">
        <img class="avatar-tiny" src="{{$post->user->avatar}}" title="{{$post->user->username}}" data-toggle="tooltip"
            data-placement="top" />
    </div>
    <div class="col">
        <p class="lead mb-0 p-2">{{$post->title}}</p>
    </div>

    <span class="text-muted small">
        @if (!isset($hideAuthor))
        by {{$post->user->username}}
        @endif
        {{$post->created_at->diffForHumans()}}


        {{-- ** If you want to show who and when was the post edited **
        @if ($post->updated_at != $post->created_at)
        <br />
        Edited by {{$post->updater->username}} {{$post->updated_at->diffForHumans()}}
        @endif --}}
    </span>
</a>