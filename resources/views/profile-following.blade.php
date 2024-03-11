<x-profile :sharedData="$sharedData" doctitle="Who {{$sharedData['username']}} follows">
    <div class="list-group">
        @forelse ($following as $follow)
        <a href="/profile/{{$follow->userBeingFollowed->username}}"
            class="d-flex list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{$follow->userBeingFollowed->avatar}}" />
            {{$follow->userBeingFollowed->username}}
            <span class="follower-count rounded-circle">Following:
                {{$follow->userBeingFollowed->followingUsers()->count()}}</span>
        </a>
        @empty
        <p>This user is not following anyone..</p>
        @endforelse
    </div>
</x-profile>