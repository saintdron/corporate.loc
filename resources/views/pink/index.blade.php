@extends(env('THEME') . '.layouts.site')

@section('navigation')
    {!! $navigation_sect !!}
@endsection

@section('slider')
    {!! $slider_sect !!}
@endsection

@section('content')
    {!! $content_sect !!}
@endsection

@section('sidebar')
    {!! $rightBar_sect !!}
@endsection

@section('footer')
    {!! $footer_sect !!}
@endsection