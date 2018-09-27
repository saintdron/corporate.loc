@if($articles)
    <div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Добавленные статьи</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Изображение</th>
                        <th>Категория</th>
                        <th>Автор</th>
                        <th>Псевдоним</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="align-left">{!! Html::link(route('admin.articles.edit', ['articles' => $article->alias]), $article->title) !!}</td>
                            <td class="align-left">{!! strip_tags(str_limit($article->text, 200)) !!}</td>
                            <td>
                                @if(isset($article->img->mini))
                                    {!! Html::image(asset(config('settings.theme')) . '/images/' . config('settings.articles_path') . '/' . $article->img->mini) !!}
                                @endif
                            </td>
                            <td>{{$article->category->title}}</td>
                            <td>{{$article->user->name}}</td>
                            <td>{{$article->alias}}</td>
                            <td>
                                <label class='btn {{ $article->fixed ? 'btn-come-to-me-4' : 'btn-clear-3' }}'
                                       title='{{ $article->fixed ? 'Убрать статью с главной' : 'Закрепить вверху списка статей' }}'>
                                    <span>{{ $article->fixed ? 'Открепить' : 'Закрепить' }}</span>
                                    {!! Form::checkbox('fixed', $article->id, $article->fixed, ['data-action' => route('articlesFix', $article->alias), 'hidden' => true]) !!}
                                </label>

                                {!! Form::open(['url' => route('admin.articles.destroy', ['articles' => $article->alias]), 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                @method('DELETE')
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type' => 'submit', 'title' => 'Удалить статью']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{--Модальное окно удаления--}}
                <div id="dialog-confirm" title="Удаление материала">
                    <p><img src="{{ asset(config('settings.theme')) }}/images/icons/set_icons/info32.png" alt="info" class="icon">Вы уверены, что хотите удалить эту статью?</p>
                </div>
            </div>
            {!! HTML::link(route('admin.articles.create'), 'Добавить  материал', ['class' => 'btn btn-the-salmon-dance-3']) !!}
        </div>
    </div>
@endif