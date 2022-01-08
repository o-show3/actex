@extends('admin.common.layout')
{{-- タイトル --}}
@section('title', '興味')
{{-- コンテンツ --}}
@section('content')
    <div class="flex flex-wrap">
        @foreach($categories as $category)
        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mb-4">
        <form action="{{route('category.add', ['id' => $category->id])}}" method="post" >
            @csrf
            <input type="submit" value="{{$category->description}}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold w-full py-2 h-16 border border-gray-400 rounded shadow">
        </form>
        </div>
        @endforeach
    </div>
@endsection
