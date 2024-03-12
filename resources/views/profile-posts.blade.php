<x-profile :sharedData="$sharedData" doctitle="{{$sharedData['username']}}'s Profile">
    <div class="list-group">
        @foreach ($posts as $post)
        <x-post :post="$post" hideAuthor="true" />
        @endforeach
    </div>
    <div class="mt-3">
        {{$posts->links()}}
    </div>
</x-profile>