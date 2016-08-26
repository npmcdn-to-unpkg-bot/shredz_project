@extends('themes.default.layout')

@section('content')
    <main>
        <div class="content">
            <div class="title">
                <h1>{{ $page['title'] }}</h1>
            </div>
            <div>
                {!! $page['content'] !!}
            </div>
        </div><!-- content -->
    </main><!-- main -->
@stop
