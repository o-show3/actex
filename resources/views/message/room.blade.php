@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'チャット')
{{-- コンテンツ --}}
@section('content')
    <div>
        @foreach($messageRoom as $messageUser)
        <p>
            <span>{{$messageUser->message->message}}</span>
            <span>({{$messageUser->message->created_at}})</span>
        </p>
        @endforeach
    </div>
@endsection
