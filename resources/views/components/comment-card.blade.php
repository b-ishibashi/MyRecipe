<article class="comment-card mb-3" style="border: 1px solid #00CED1; border-radius: 6px; width: 600px" >
    <div class="p-2 d-flex flex-column align-items-start" style="background: #00CED1; border-radius: 6px 6px 0 0">
        <a href="{{ action('UserController@show', $comment->user) }}" class="d-flex justify-content-start">
            <img class="border rounded-circle" src="{{ asset($comment->user->avatar) }}" width="32" height="32">
            <p class="pl-2" style="margin: 0;">{{ $comment->user->name }}</p>
        </a>
        <small class="align-self-end">{{ $comment->updated_at }}</small>
    </div>
    <div class="p-2">{!! nl2br(e($comment->body)) !!}</div>
</article>
