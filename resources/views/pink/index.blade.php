@extends(env('THEME') . '.layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('slider')
    {!! $slider_sect !!}
@endsection

@section('content')
    {!! $content_sect !!}
@endsection