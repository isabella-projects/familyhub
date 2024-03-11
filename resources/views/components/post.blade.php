<a href="/post/{{$post->id}}" class="d-flex align-items-center list-group-item p-3 list-group-item-action">
    <div class="col-auto">
        <img class="avatar-tiny" src="{{$post->user->avatar}}" title="{{$post->user->username}}" data-toggle="tooltip"
            data-placement="top" />
    </div>
    <div class="col">
        <strong>{{$post->title}}</strong>
    </div>

    <span class="text-muted small">
        @if (!isset($hideAuthor))
        by {{$post->user->username}}
        @endif
        {{$post->created_at->diffForHumans()}}
    </span>
</a>