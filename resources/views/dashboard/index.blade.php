@extends('layouts.dashboard')

@section('content')
    {!! $content !!}
@endsection

@section('include_css_lib')
    @if(isset($inc_css_lib))
        @foreach($inc_css_lib as $item => $value)
            {!!  $value['url'] !!}
        @endforeach
    @endif
@endsection

@section('include_last_css_lib')
    @if(isset($inc_last_css_lib))
        @foreach($inc_last_css_lib as $item => $value)
            {!!  $value['url'] !!}
        @endforeach
    @endif
@endsection

@section('include_js_lib')
    @if(isset($inc_js_lib))
        @foreach($inc_js_lib as $item => $value)
            {!!  $value['url'] !!}
        @endforeach
    @endif
@endsection

@section('include_js')
    @if(isset($inc_js))
        {!!  $inc_js !!}
    @endif
@endsection