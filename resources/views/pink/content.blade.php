@if($portfolio && count($portfolio) > 0)
    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                <h3 class="title">{{ trans('custom.latest_projects') }}</h3>

                @foreach($portfolio as $k=>$item)
                    @if ($k === 0)
                        <div class="hentry work group portfolio-sticky portfolio-full-description">
                            <div class="work-thumbnail">
                                <a class="thumb">
                                    <img src="{{ asset(env('THEME')) }}/images/{{ Config::get('settings.portfolio_path') }}/{{ $item->img->max }}"
                                         alt="{{ $item->title }}"
                                         title="{{ $item->title }}"/>
                                </a>
                                <div class="work-overlay">
                                    <h3>
                                        <a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
                                    </h3>
                                    <p class="work-overlay-categories">
                                        <img src="{{ asset(env('THEME')) }}/images/categories.png"
                                             alt="Categories"/> in: <a href="#">{{ $item->filter->title }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="work-description">
                                <h2>
                                    <a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
                                </h2>
                                <p class="work-categories">in: <a href="#">{{ $item->filter->title }}</a></p>
                                <p>{{ str_limit($item->text, 200) }}</p>
                                <a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}" class="read-more">|| Read more</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                        @continue
                    @endif

                    @if ($k === 1)
                    <div class="portfolio-projects">
                    @endif
                        <div class="related_project {{ ($k === Config::get('settings.home_portfolio_count') - 1) ? 'related_project_last' : '' }}">
                            <div class="overlay_a related_img">
                                <div class="overlay_wrapper">
                                    <img src="{{ asset(env('THEME')) }}/images/{{ Config::get('settings.portfolio_path') }}/{{ $item->img->mini }}" alt="{{ $item->alias }}"
                                         title="{{ $item->alias }}"/>
                                    <div class="overlay">
                                        <a class="overlay_img"
                                           href="{{ asset(env('THEME')) }}/images/{{ Config::get('settings.portfolio_path') }}/{{ $item->img->path }}" rel="lightbox"
                                           title=""></a>
                                        <a class="overlay_project" href="{{ route('portfolio.show', ['alias' => $item->alias]) }}"></a>
                                        <span class="overlay_title">{{ $item->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <h4>
                                <a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
                            </h4>
                            <p>{{ str_limit($item->text, 200) }}</p>
                        </div>

                @endforeach
                    </div>
            </div>
            <div class="clear"></div>
        </div>

        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>

@else
    <p>Нет портфолио</p>
@endif