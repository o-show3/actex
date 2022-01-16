@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'メッセージ')
{{-- コンテンツ --}}
@section('content')
    <div>
        @foreach($messageList as $messageItem)
        <form method="get" action="{{route('message.room', ['pairing_user_id' => $messageItem->pairingUser->encrypted_id])}}">
            @csrf
            <input type="hidden" name="user" value="{{$messageItem->pairingUser->encrypted_id}}" >
            <button type="submit">
                <span>{{$messageItem->pairingUser->name}}</span>：
                <span>
                    @php
                        $latestMessage = \App\Facades\Message::getLastMessage(\Illuminate\Support\Facades\Auth::id(), $messageItem->pairingUser->id);
                    @endphp
                    @if($latestMessage != null)
                        {{$latestMessage}}
                    @else
                        <span style="color: #4a5568">まだやりとりを開始していません。</span>
                    @endif
                </span>
            </button>
        </form>
        @endforeach
    </div>
@endsection
