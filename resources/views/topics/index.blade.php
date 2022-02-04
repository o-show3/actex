@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', '話題')
{{-- コンテンツ --}}
@section('content')
    <div class="flex flex-wrap">
        @foreach($topicCollection as $topic)
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mb-4 border-solid" >
                <img class="h-40" src="{{$topic->url_to_image}}">
                <a href="{{$topic->url}}" target="_blank" >{{$topic->title}}</a>
                <div class="buttons">
                    @if(!in_array($topic->id, $userTopicsList))
                    <span>気になる！済み</span>
                    @else
                    {{-- 気になる --}}
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('topics.topic-like', $topic->uuid)}}">
                        気になる！
                    </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
