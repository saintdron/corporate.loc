@foreach($items as $item)
    <li id="li-comment-{{ $item->id }}"
        class="comment even {{ ($item->user_id === $article->user_id) ? 'bypostauthor odd' : '' }}">
        <div id="comment-{{ $item->id }}" class="comment-container">
            <div class="comment-author vcard">
                @set($hash, isset($item->email) ? md5($item->email) : md5($item->user->email))
                <img alt="{{ ($item->name) ? $item->name : (($item->user->name) ? $item->user->name : 'Anonymous') }}"
                     src="https://www.gravatar.com/avatar/{{ $hash }}?d=mp&s=75" class="avatar" height="75" width="75"/>
                <cite class="fn">{{ ($item->name) ? $item->name : (($item->user->name) ? $item->user->name : 'Anonymous') }}</cite>
            </div>
            <!-- .comment-author .vcard -->
            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        <a href="#comment-2">
                            {{ $item->formatCreatedAtDate('%B %d, %Y'). ' в '. $item->formatCreatedAtDate('%R') }}</a>
                    </div>
                    <div class="commentNumber">#&nbsp;</div>
                </div>
                <div class="comment-body">
                    <p>{{ $item->text }}</p>
                </div>
                <div class="reply group">
                    <a class="comment-reply-link" href="#respond"
                       onclick="return addComment.moveForm(&quot;comment-{{ $item->id }}&quot;, &quot;{{ $item->id }}&quot;, &quot;respond&quot;, &quot;{{ $article->id }}&quot;)">{{ config('custom.reply') }}</a>
                </div>
                <!-- .reply -->
            </div>
            <!-- .comment-meta .commentmetadata -->
        </div>
        <!-- #comment-##  -->

        @if(isset($com[$item->id]))
            <ul class="children">
                @include(env('THEME') . '.comment', ['items' => $com[$item->id]])
            </ul>
        @endif
    </li>
@endforeach