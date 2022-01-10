@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'マッチング機能')
{{-- コンテンツ --}}
@section('content')
    <div>
    <p>マッチング済み</p>
    <ul>
    @foreach($pairs as $pair)
        <li>{{$pair->pairingUser->name}}</li>
    @endforeach
    </ul>
    <p>マッチング候補</p>
    @foreach($candidates as $candidate)
        <form method="post" name="pairing-{{$candidate->encrypted_id}}">
            <div>
            @csrf
            <input type="hidden" name="user" value="{{$candidate->encrypted_id}}" >
            <p>{{$candidate->name}}</p>
            <input type="submit" formaction="{{route('users.pair-like')}}" value="Like!">
            <input type="submit" formaction="{{route('users.pair-none')}}" value="None.">
        </div>
        </form>
        @endforeach

    </div>
@endsection
