@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'チャット:'.$pairing_user->name)
{{-- コンテンツ --}}
@section('content')
    <div>
        @foreach($messageRoom as $messageUser)
        <p>
            <span>{{$messageUser->user->name}}</span>
            @if($messageUser->message->type == \App\Models\Message::TYPE_TEXT)
            <span>{{App\Facades\Message::decryptMessage($messageUser->message->message)}}</span>
            @elseif($messageUser->message->type == \App\Models\Message::TYPE_IMAGE)
            <img style="max-height: 300px; max-width: 600px;" src="{{\Illuminate\Support\Facades\Storage::url($messageUser->message->file->path)}}">
            @endif
            <span>({{$messageUser->message->created_at}})</span>
        </p>
        @endforeach
    </div>
    <form method="post" action="{{route('message.room-post-message', ['pairing_user_id' => $pairing_user->encrypted_id])}}">
        @csrf
        <input type="text" name="message" value="" >
        <input type="submit" value="投稿する">
    </form>
    <form method="POST" action="{{route('message.room-post-file', ['pairing_user_id' => $pairing_user->encrypted_id])}}" enctype="multipart/form-data">
        <button>
            @csrf
            <input type="file" id="file" name="file" class="form-control">
            <button type="submit">アップロード</button>
        </button>
    </form>
@endsection
