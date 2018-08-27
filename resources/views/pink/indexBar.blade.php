<div class="widget-first widget recent-posts">
    @if($articles)
        <h3>{{ trans('custom.from_blog') }}</h3>
        <div class="recent-post group">
            @foreach($articles as $article)
                <div class="hentry-post group">
                    <div class="thumb-img">
                        <img src="{{ asset(env('THEME')) }}/images/{{ Config::get('settings.article_path') }}/{{ $article->img->mini }}"
                             alt="{{ $article->title }}" title="{{ $article->title }}"/>
                    </div>
                    <div class="text">
                        <a href="{{ route('articles.show', ['alias' => $article->alias]) }}"
                           title="{{ $article->title }}"
                           class="title">{{ $article->title }}</a>
                        <?php
                        $loc_ru = setlocale(LC_ALL, 'rus', 'ru', 'ru_RU', 'rus', 'Russian_ru', 'ru_RU.UTF-8', 'ru_RU.utf8', 'ru_RU.1251', 'ru_RU.cp1251', 'ru_Russian', 'ru_RU.utf-8', 'Russian_Russia.utf-8');
                        // $currentLocal = setlocale(LC_ALL, 0);
                        // dd($currentLocal);
                        ?>
                        <p class="post-date">{{ $article->formatDate() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="widget-last widget text-image">
    <h3>Customer support</h3>
    <div class="text-image" style="text-align:left">
        <img src="{{ asset(env('THEME')) }}/images/callus.gif"
             alt="Customer support"/>
    </div>
    <p>Proin porttitor dolor eu nibh lacinia at ultrices lorem venenatis. Sed volutpat scelerisque
        vulputate. </p>
</div>

