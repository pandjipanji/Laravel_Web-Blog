<div class="row" id="comment_ajax">
    @foreach($comments as $comment)
        <div class="col-lg-9" style="margin:10px; padding-top:10px; background-color: #ebebeb; border-radius: 3px;">
            <strong><i>{!! $comment->user !!}</i></strong>
            <p class="autofocus">{!! $comment->content !!}</p>
        </div>
    @endforeach
</div>