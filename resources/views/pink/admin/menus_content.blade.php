<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Пункты меню</h3>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <th>Название</th>
                    <th>Ссылка</th>
                    <th>Удалить</th>
                </thead>
                <tbody>
                @if($menus)
                    @include(env('THEME') . '.admin.customMenuItems', array('items' => $menus->roots(), 'paddingLeft' => ''))
                @endif
                </tbody>
            </table>
        </div>
        {!! HTML::link(route('admin.menus.create'),'Добавить  пункт',['class' => 'btn btn-the-salmon-dance-3']) !!}
    </div>
</div>