<x-layout>
    @section('title')
        マッチング機能
    @endsection
    @section('subtitle')
        マッチしたユーザとマッチしそうなユーザを表示します
    @endsection
    @section('content')
    <div class="mt-2">
        <h1 class="display-6">マッチング済み</h1>
        <p class="lead"></p>
        <div class="container-fluid">
            <div class="list-group list-group-flush ">
            @foreach($pairs as $pair)
                <a href="{{route('message.room', ['pairing_user_id' => $pair->encrypted_id])}}" class="list-group-item list-group-item-action">
                    {{$pair->name}}：
                    @php
                        $latestMessage = \App\Facades\Message::getLastMessage(\Illuminate\Support\Facades\Auth::id(), $pair->id);
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
                </a>
            @endforeach
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h1 class="display-6">LIKE済み</h1>
        <p class="lead"></p>
        <div class="container-fluid">
            <div class="list-group list-group-flush ">
            @foreach($likes as $like)
                @if($like->status === \App\Models\Pair::STATUS_LIKE)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$like->pairingUser->name}}
                </a>
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h1 class="display-6">マッチング候補</h1>
        <p class="lead"></p>
        <div class="container-fluid">
            <div class="list-group list-group-flush ">
                @foreach($candidates as $candidate)
                <div class="list-group-item">
                    <form method="post" name="pairing-{{$candidate->getUser()->encrypted_id}}">

                        @csrf
                        <input type="hidden" name="user" value="{{$candidate->getUser()->encrypted_id}}" >
                        <span class="me-2">{{$candidate->getUser()->name}}</span>
                        <input type="submit" class="btn btn-primary" formaction="{{route('users.pair-like')}}" value="Like!">
                        <input type="submit" class="btn btn-danger" formaction="{{route('users.pair-none')}}" value="None.">
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection
</x-layout>
