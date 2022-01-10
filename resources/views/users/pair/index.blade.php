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
    <ul>
    @foreach($candidates as $candidate)
        <li>{{$candidate->name}}</li>
    @endforeach
    </ul>
    </div>
@endsection
