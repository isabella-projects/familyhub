@if ($isAdmin)
<span class="text-danger role" title="Administrator" data-toggle="tooltip" data-placement="top"><i
        class="fas fa-user-shield fa-xs"></i></span>
@else
<span class="text-primary role" title="User" data-toggle="tooltip" data-placement="top"><i
        class="fas fa-user-alt fa-xs"></i></span>
@endif