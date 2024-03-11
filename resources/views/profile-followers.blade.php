<x-profile :sharedData="$sharedData" doctitle="{{$sharedData['username']}}'s Followers">
    <div class="list-group">
        @forelse ($followers as $follow)
        <a href="/profile/{{$follow->userDoingTheFollow->username}}"
            class="d-flex list-group-item list-group-item-action">
            <img class="avatar-tiny" src="{{$follow->userDoingTheFollow->avatar}}" />
            {{$follow->userDoingTheFollow->username}}
            <span class="follower-count rounded-circle">Followers:
                {{$follow->userDoingTheFollow->followers()->count()}}</span>
        </a>
        @empty
        <p>No one is following this user..</p>
        @endforelse
    </div>
</x-profile>