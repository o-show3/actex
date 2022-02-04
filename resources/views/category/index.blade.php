<x-layout>
    @section('title')
    {{__('Function-Category')}}
    @endsection
    @section('subtitle')
        興味のあるハッシュタグを選択しましょう！
    @endsection
    @section('content')
    <div class="columns">
        <div class="column">
            <h1 class="title">登録済みハッシュタグ</h1>
            <div class="field is-grouped is-grouped-multiline">
                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Technology</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">CSS</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Flexbox</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Web Design</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Open Source</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Community</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Documentation</a>
                        <a class="tag is-delete"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column"></div>
    </div>
    <h1 class="title">登録するハッシュタグ</h1>
    <div class="columns">
        @foreach($categories as $category)
        <div class="column">
            <form action="{{route('category.add', ['id' => $category->id])}}" method="post" >
                @csrf
                <input type="hidden" name="category_key" value="{{$category->uuid}}">
                <input type="submit" value="{{$category->description}}" class="button is-primary is-light">
            </form>
        </div>
        @endforeach
    </div>
    @endsection
</x-layout>

