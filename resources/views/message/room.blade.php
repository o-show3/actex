@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'チャット:'.$pairing_user->name)
{{-- コンテンツ --}}
@section('content')
    <div>
        @foreach($messageRoom as $messageUser)
        <p>
            <span>{{$messageUser->user->name}}</span>
            <span>{{App\Facades\Message::decryptMessage($messageUser->message->message)}}</span>
            <span>({{$messageUser->message->created_at}})</span>
        </p>
        @endforeach
    </div>
    <form method="post" action="{{route('message.room-post-message', ['pairing_user_id' => $pairing_user->encrypted_id])}}">
        @csrf
        <input type="text" name="message" value="" >
        <input type="submit" value="投稿する">
    </form>
@endsection
