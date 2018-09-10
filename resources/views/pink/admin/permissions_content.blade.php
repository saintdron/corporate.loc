<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">{{ trans('custom.title_page_permission') }}</h3>
        <form action="{{ route('admin.permissions.store') }}" method="post">
            @csrf
            <div class="short-table white">
                <table style="width: 100%">
                    <thead>
                    <th>Привилегии</th>
                    @if(!$roles->isEmpty())
                        @foreach($roles as $role)
                            <th>{{ $role->name }}</th>
                        @endforeach
                    @endif
                    </thead>
                    <tbody>
                    @if(!$permissions->isEmpty())
                        @foreach($permissions as $perm)
                            <tr>
                                <td>{{ $perm->name }}</td>
                                @foreach($roles as $role)
                                    <td>
                                        @if($role->hasPermission($perm->name))
                                            <input checked name="" type="checkbox" value="">
                                        @else
                                            <input name="" type="checkbox" value="">
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <input class="btn btn-the-salmon-dance-3" type="submit" value="Обновить">
        </form>
    </div>
</div>