<x-layout>
    @section('title')
        {{__('メッセージ')}}
    @endsection
    @section('subtitle')
        メッセージを送り合いましょう！
    @endsection
    @section('content')
    <div class="mt-2">
        <h1 class="display-6">メッセージ</h1>
        <p class="lead">やりとりをしているユーザを一覧表示</p>
        <div class="container-fluid">
            <div class="card-group">
            @foreach($messageList as $key => $messageItem )
                <div class="card text-dark bg-light m-1">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$messageItem->pairingUser->name}}</h5>
                        <p class="card-text">
                            @php
                                $latestMessage = \App\Facades\Message::getLastMessage(\Illuminate\Support\Facades\Auth::id(), $messageItem->pairingUser->id);
                            @endphp
                            @if($latestMessage != null)
                                @if( $latestMessage->file_id != null && $latestMessage->type == \App\Models\Message::TYPE_IMAGE )
                                    画像を送信しました
                                @elseif( $latestMessage->type == \App\Models\Message::TYPE_TEXT )
                                    {{ \App\Facades\Message::decryptMessage($latestMessage->message)  }}
                                @endif
                            @else
                                <span style="color: #4a5568">まだやりとりを開始していません。</span>
                            @endif
                        </p>
                        <div class="d-grid gap-2">
                        <a class="btn  btn-primary" href="{{route('message.room', ['pairing_user_id' => $messageItem->pairingUser->encrypted_id])}}">
                            メッセージを開く
                        </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endsection
</x-layout>

