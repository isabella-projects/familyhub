<x-layout>
    <div class="fullheight container py-md-5">
        <div class="row align-items-center">
            <div class="col-lg-7 py-md-5">
                <h1 class="display-3">Family Hub</h1>
                <p class="lead ml-1 font-italic text-muted">Your family social media portal..</p>
                <p class="lead ml-1">The right place to share, save and talk about your best moments with
                    your
                    beloved ones.
                </p>
                <p class="lead ml-1">
                    Currently there are
                    <span style="font-weight:600;">{{$postCount}}</span>
                    shared posts from family members.
                </p>
            </div>

            <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <h4 class="lead mb-4">Don't have an account?</h4>
                <form action="/register" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group">
                        <label for="username-register" class="text-muted mb-1"><small>Username</small></label>
                        <input value="{{old('username')}}" name="username" id="username-register" class="form-control"
                            type="text" placeholder="Pick a username" autocomplete="off" />
                        @error('username')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                        <input value="{{old('email')}}" name="email" id="email-register" class="form-control"
                            type="text" placeholder="you@example.com" autocomplete="off" />
                        @error('email')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
                        <input name="password" id="password-register" class="form-control" type="password"
                            autocomplete="new-password" placeholder="Create a password" />
                        @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register-confirm" class="text-muted mb-1"><small>Confirm
                                Password</small></label>
                        <input name="password_confirmation" id="password-register-confirm" class="form-control"
                            type="password" autocomplete="new-password" placeholder="Confirm password" />
                        @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Sign up for Family
                        Hub</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>