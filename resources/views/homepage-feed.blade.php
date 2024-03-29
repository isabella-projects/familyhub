<x-layout>
    <div class="homepage--feed d-flex align-items-center flex-column mt-5 container py-md-5 container--narrow">

        @unless ($posts->isEmpty())
        <h2 class="text-center mb-4">
            The latest from your friends
        </h2>
        <div class="list-group w-100">
            @foreach ($posts as $post)
            <x-post :post="$post" />
            @endforeach
        </div>

        <div class="pages mt-3">
            {{$posts->links()}}
        </div>

        @else
        <div class="text-center">
            <h2>Hello <strong>{{auth()->user()->username}}</strong>, your feed is empty.</h2>
            <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you
                don&rsquo;t have any friends to follow that&rsquo;s okay; you can use the &ldquo;Search&rdquo; feature
                in the top menu bar to find content written by people with similar interests and then follow them.</p>
        </div>
        @endunless
    </div>
</x-layout>