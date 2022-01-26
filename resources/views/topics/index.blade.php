@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', '話題')
{{-- コンテンツ --}}
@section('content')
    <div class="flex flex-wrap">
        @foreach($newsCollection as $news)
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mb-4 border-solid" >
                <img class="h-40" src="{{$news->urlToImage()}}">
                <a>{{$news->title()}}</a>
            </div>
        @endforeach
    </div>
@endsection
