@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', '管理画面:マッチング一覧')
{{-- コンテンツ --}}
@section('content')
    <div>
    <ul>
    @foreach($pairs as $pair)
        <li>{{$pair->pairingUser->name}}</li>
    @endforeach
    </ul>
    </div>
@endsection
