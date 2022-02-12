<x-layout>
    @section('title')
        チャットルーム：{{$pairing_user->name}}
    @endsection
    @section('subtitle')
        個人チャットルーム
    @endsection
    @section('content')
    <div class="mt-2">
        <div class="container-fluid">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="{{\Illuminate\Support\Facades\Storage::url('public/user/'.$pairing_user->id.'/icon.png')}}" class="rounded-circle mr-1" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>チャットルーム：{{$pairing_user->name}}</strong>
                                    <div class="text-muted small">個人チャットルーム</div>
                                </div>
{{--                                <div>--}}
{{--                                    <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>--}}
{{--                                    <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>--}}
{{--                                    <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                @foreach($messageRoom as $messageUser)
                                @if($messageUser->user->id == \Illuminate\Support\Facades\Auth::id())
                                {{-- 本人用　--}}
                                <div class="chat-message-right pb-4" style="display: flex;flex-shrink: 0;margin-right: auto">
                                    <div>
                                        <img src="{{\Illuminate\Support\Facades\Storage::url('public/user/'.$messageUser->user->id.'/icon.png')}}" class="img-fluid rounded-circle mr-1" alt="..." style="max-width: 35px;display: inline">
                                        <div class="text-muted small text-nowrap mt-2">
                                            You
                                        </div>
                                        @if(!in_array($messageUser->message->id, $kidokuList ))
                                            <span class="text-muted small">既読</span>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-1 rounded py-2 px-3 ms-3" style="background-color: aquamarine">
                                        <div class="font-weight-bold mb-1">{{$messageUser->message->created_at}}</div>
                                        @if($messageUser->message->type == \App\Models\Message::TYPE_TEXT)
                                            <span>{{App\Facades\Message::decryptMessage($messageUser->message->message)}}</span>
                                        @elseif($messageUser->message->type == \App\Models\Message::TYPE_IMAGE)
                                            @if($messageUser->message->file != null)
                                            <img style="max-height: 300px; max-width: 600px;" src="{{\Illuminate\Support\Facades\Storage::url($messageUser->message->file->path)}}">
                                            @else
                                            <span style="color: red">エラー：送信されたファイルが参照できませんでした。</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="chat-message-left pb-4" style="display: flex;flex-shrink: 0;flex-direction: row-reverse;margin-left: auto">
                                    <div>
                                        <img src="{{\Illuminate\Support\Facades\Storage::url('public/user/'.$messageUser->user->id.'/icon.png')}}" class="img-fluid rounded-circle mr-1" alt="..." style="max-width: 35px;display: inline">
                                        <div class="text-muted small text-nowrap mt-2">
                                            {{$messageUser->user->name}}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-1 rounded py-2 px-3 me-3" style="background-color: gainsboro">
                                        <div class="font-weight-bold mb-1">{{$messageUser->message->created_at}}</div>
                                        @if($messageUser->message->type == \App\Models\Message::TYPE_TEXT)
                                            <span>{{App\Facades\Message::decryptMessage($messageUser->message->message)}}</span>
                                        @elseif($messageUser->message->type == \App\Models\Message::TYPE_IMAGE)
                                            @if($messageUser->message->file != null)
                                            <img style="max-height: 300px; max-width: 600px;" src="{{\Illuminate\Support\Facades\Storage::url($messageUser->message->file->path)}}">
                                            @else
                                            <span style="color: red">エラー：送信されたファイルが参照できませんでした。</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form method="POST" action="{{route('message.room-post-file', ['pairing_user_id' => $pairing_user->encrypted_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-2">
                                    <label for="file" class="form-label mr-4">添付ファイル</label>
                                    <input type="file" class="form-control" id="file" name="file" class="form-control">
                                    <button type="submit" class="btn btn-primary">アップロード</button>
                                </div>
                            </form>

                            <form method="post" action="{{route('message.room-post-message', ['pairing_user_id' => $pairing_user->encrypted_id])}}">
                                <div class="input-group">
                                    @csrf
                                    <input type="text" class="form-control" name="message" value=""  placeholder="メッセージを入力">
                                    <input type="submit" class="btn btn-primary" value="投稿する">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-layout>
