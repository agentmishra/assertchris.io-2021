@extends('layout')

@section('content')
    <div class="flex flex-col w-full px-4 article">
        <h1>{{ $post->title }}</h1>
        <div class="text-sm text-gray-500">{{ $post->publish_date->format('jS F Y') }}</div>
        {!! $post->content !!}
    </div>
    @include('includes.newsletter')
@endsection
