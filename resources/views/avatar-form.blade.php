<x-layout>
    <div class="homepage--avatar container container--narrow py-md-5">
        <h2 class="text-center mb-5">Upload a new avatar</h2>
        <form action="/manage-avatar" method="POST" enctype="multipart/form-data"
            class="d-flex justify-content-center align-items-center flex-column gap-3">
            @csrf
            <div class="wrap mb-5 d-flex flex-column align-items-center gap-3">
                <img src="{{$avatar}}" alt="Avatar" class="front-logo rounded-circle shadow-lg mb-5">
                <input type="file" name="avatar" required>
                @error('avatar')
                <p class="alert small alert-danger shadow-sm">
                    {{$message}}
                </p>
                @enderror
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</x-layout>