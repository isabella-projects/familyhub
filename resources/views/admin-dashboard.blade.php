<x-layout>
    <div class="homepage admin-dashboard d-flex flex-column align-items-center">
        <h2 class="text-center">
            Welcome @include('role') <strong>{{auth()->user()->username}}</strong>! You are at the <strong>Admin
                dashboard</strong>.
        </h2>
        <p class="text-center">The admin dashboard is currently <span class="text-danger">NOT</span> available.
        </p>
    </div>
</x-layout>