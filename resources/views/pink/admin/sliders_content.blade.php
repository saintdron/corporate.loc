@if($sliders)
    <div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Добавленные слайды</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th style='max-width: 10px; padding-left: 0; padding-right: 0;'>Номер</th>
                        <th>Изображение</th>
                        <th>Заглавие</th>
                        <th>Описание</th>
                        <th>Размещение текста</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td style='max-width: 10px'>{!! Html::link(route('admin.sliders.edit', ['sliders' => $slider->id]), $slider->id) !!}</td>
                            <td><a href="{{ route('admin.sliders.edit', ['sliders' => $slider->id]) }}">
                                    {!! Html::image(asset(config('settings.theme')) . '/images/' . config('settings.slider_path') . '/' . $slider->img) !!}
                                </a>
                            </td>
                            <td class="align-left" style="background-color: lightgrey;">{!! str_limit($slider->title, 200) !!}</td>
                            <td class="align-left">{!! str_limit($slider->desc, 200) !!}</td>
                            <td class="{{ $slider->position->class }}">{{ $slider->position->text }}</td>
                            <td>
                            {!! Form::open(['url' => route('admin.sliders.destroy', ['sliders' => $slider->id]), 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                            @method('DELETE')
                            {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! HTML::link(route('admin.sliders.create'), 'Добавить  слайд', ['class' => 'btn btn-the-salmon-dance-3']) !!}
        </div>
    </div>
@endif