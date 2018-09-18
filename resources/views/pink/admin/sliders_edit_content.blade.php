<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($slider->id)) ? route('admin.sliders.update', ['sliders' => $slider->id]) : route('admin.sliders.store'), 'class' => 'contact-form', 'files' => true]) !!}

        @if(isset($slider->id))
            @method("PUT")
        @endif

        <ul>
            <li class="text-field">
                <label for="title">
                    <span class="label">Заглавие:</span><br/>
                    <span class="sublabel">HTML заголовка слайда</span><br/>
                </label>
                <div class="input-prepend">
                    {{--<textarea name="title" id="title" class='form-control'>--}}
                    {{--{{ isset($slider->title) ? $slider->title : old('title') }}--}}
                    <input type="text" name="title" id="title" class='form-control'
                           value="{{ isset($slider->title) ? $slider->title : old('title') }}">
                    {{--{!! Form::text('title', isset($slider->title) ? $slider->title : old('title'), ['id' => 'title', 'class' => 'form-control']) !!}--}}
                    {{--</textarea>--}}
                </div>
                <div class="msg-error"></div>
            </li>

            <li class="textarea-field">
                <label for="desc">
                    <span class="label">Описание:</span><br/>
                    <span class="sublabel">Описание слайда</span><br/>
                </label>
                <div class="input-prepend">
                    {!! Form::textarea('desc', isset($slider->desc) ? $slider->desc : old('desc'), ['id' => 'desc', 'class' => 'form-control']) !!}
                </div>
                <div class="msg-error"></div>
            </li>


            @if(isset($slider->img))
                <li class="textarea-field">
                    <label>
                        <span class="label">Текущее изображение:</span>
                    </label>
                    {{ Html::image(asset(config('settings.theme')).'/images/' . config('settings.slider_path') . '/' . $slider->img, '', ['style' => 'width: 60%']) }}
                    {!! Form::hidden('old_image', $slider->img) !!}
                </li>
            @endif

            <li class="text-field">
                <label>
                    <span class="label">Изображение:</span><br/>
                    <span class="sublabel">Изображение материала</span><br/>
                </label>
                <div class="input-prepend">
                    {!! Form::file('image', ['class' => 'filestyle', 'data-text' => 'Выберите изображение', 'data-btnClass' => "btn-primary", 'data-placeholder' => "Файла нет"]) !!}
                </div>
            </li>

            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3', 'type'=>'submit']) !!}
            </li>
        </ul>

        {!! Form::close() !!}

        <script>
            // CKEDITOR.replace('title');
        </script>
    </div>
</div>