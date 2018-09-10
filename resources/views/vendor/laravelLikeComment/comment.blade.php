<?php
$GLOBALS['commentDisabled'] = "";
if(!Auth::check())
    $GLOBALS['commentDisabled'] = "disabled";
$GLOBALS['commentClass'] = -1;
?>

<div class="laravelComment" id="laravelComment-{{ $comment_item_id }}">
    <div class="ui threaded comments" id="{{ $comment_item_id }}-comment-0">
        <button class="btn btn-small btn-dark-solid  btn-transparent" id="write-comment" data-form="#{{ $comment_item_id }}-comment-form">Оставить комментарий</button>
        <form class="ui laravelComment-form form" id="{{ $comment_item_id }}-comment-form" data-parent="0" data-item="{{ $comment_item_id }}" style="display: none;">
            @if(!Auth::check())
            <br />
             <h6><a href="{{ route('login') }}">Авторизуйтесь</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы оставить комментарий.</h6>
            @else
            <div class="field">
                <textarea id="0-textarea" class="comments-form-control" rows="3" {{ $GLOBALS['commentDisabled'] }}></textarea>
            </div>
            <input type="submit" class="btn btn-extra-small btn-dark-solid  btn-transparent" value="Отправить" {{ $GLOBALS['commentDisabled'] }}>
            @endif
        </form>
<?php
$GLOBALS['commentVisit'] = array();

function dfs($comments, $comment){
    $GLOBALS['commentVisit'][$comment->id] = 1;
    $GLOBALS['commentClass']++;
?>
    <div class="comment show-{{ $comment->item_id }}-{{ (int)($GLOBALS['commentClass'] / 5) }}" id="comment-{{ $comment->id }}">
        <a class="avatar">
        @if ($comment->avatar)
            <img src="{{ asset('assets') }}/img/post/{{ $comment->avatar }}">
        @else
            <img src="{{ asset('assets') }}/img/post/a1.png">
        @endif
        </a>
        <div class="content">
            <a class="author" url="{{ $comment->url or '' }}"> {{ $comment->name }} </a>
            <div class="metadata">
                <span class="date">{{ Date::parse($comment->updated_at)->diffForHumans() }}</span>
            </div>
            <div class="text">
                {{ $comment->comment }}
            </div>
            <div class="actions">
                <a class="{{ $GLOBALS['commentDisabled'] }} reply reply-button" data-toggle="{{ $comment->id }}-reply-form">Ответить</a>
            </div>
            {{ \risul\LaravelLikeComment\Controllers\CommentController::viewLike('comment-'.$comment->id) }}
            <form id="{{ $comment->id }}-reply-form" class="ui laravelComment-form form" data-parent="{{ $comment->id }}" data-item="{{ $comment->item_id }}" style="display: none;">
                <div class="field">
                    <textarea id="{{ $comment->id }}-textarea" class="comments-form-control" rows="5" {{ $GLOBALS['commentDisabled'] }}></textarea>
                    @if(!Auth::check())
                        <small>Пожалуйста, зарегистрируйтесь, чтобы оставить комментарий</small>
                    @endif
                </div>
                <input type="submit" class="btn btn-extra-small btn-dark-solid  btn-transparent button" value="Отправить" {{ $GLOBALS['commentDisabled'] }}>
            </form>
        </div>
        <div class="comments" id="{{ $comment->item_id }}-comment-{{ $comment->id }}">
<?php
    foreach ($comments as $child) {
        if($child->parent_id == $comment->id && !isset($GLOBALS['commentVisit'][$child->id])){
            dfs($comments, $child);
        }
    }
    echo "</div>";
    echo "</div>";
}

$comments = \risul\LaravelLikeComment\Controllers\CommentController::getComments($comment_item_id);
foreach ($comments as $comment) {
    if(!isset($GLOBALS['commentVisit'][$comment->id])){
        dfs($comments, $comment);
    }
}
?>
    </div>
    @if ($commentcount > 0)
    <button class="btn btn-small btn-dark-solid  btn-transparent" id="showComment" data-show-comment="0" data-item-id="{{ $comment_item_id }}">Показать комментарии</button>
    <div class="cart_result" id="confirm_rez"><p></p></div>
    @endif
</div>
