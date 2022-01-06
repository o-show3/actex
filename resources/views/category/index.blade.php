@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', 'マッチング機能')
{{-- コンテンツ --}}
@section('content')
    <div>
    <ul>
    @foreach($categories as $category)
    <li>
        <p>{{$category->name}}</p>
        <span>{{$category->description}}</span>
    </li>
    @endforeach
    </ul>
@endsection
