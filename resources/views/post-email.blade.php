{{-- Just for a testing purposes, ik it's ugly --}}

<div>
    <h1>New Post created!</h1>
    <p style="margin-top: 1.5rem;">Thank you for creating a new post, <strong>{{$name}}</strong>!</p>
    <p>Your new post's name is: <strong style="text-decoration: underline">{{$title}}</strong></p>
    <p>Click the button below to view your new post:</p>
    <div style="margin-top: 1.5rem;">
        <a href="{{$link}}"
            style="padding: 20px;background-color:cornflowerblue;border-radius:5px;color:#fff;text-decoration:none;">View
            Post</a>
    </div>
</div>