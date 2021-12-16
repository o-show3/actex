@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'マッチング一覧')
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
