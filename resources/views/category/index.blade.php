<x-layout>
    @section('title')
    {{__('Function-Category')}}
    @endsection
    @section('subtitle')
        興味のあるハッシュタグを選択しましょう！
    @endsection
    @section('content')
    <div class="m-1">
        <h1 class="display-6">新しいハッシュタグ</h1>
        <p class="lead">新しいハッシュタグを設定できます</p>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    @for($i=0;$i<=34;$i++)
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-hash"></i>
                            Object
                        </button>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h1 class="display-6">登録済みのハッシュタグ</h1>
        <p class="lead">ハッシュタグを削除しましょう！</p>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    @for($i=0;$i<=34;$i++)
                        <span class="badge rounded-pill bg-danger"><i class="bi bi-x"></i></span>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">
                            <i class="bi bi-hash"></i>
                            Object
                        </button>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

            {{--    <div class="columns">--}}
{{--        <div class="column">--}}
{{--            <h1 class="title">登録済みハッシュタグ</h1>--}}
{{--            <div class="field is-grouped is-grouped-multiline">--}}
{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Technology</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">CSS</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Flexbox</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Web Design</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Open Source</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Community</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="control">--}}
{{--                    <div class="tags has-addons">--}}
{{--                        <a class="tag is-link">Documentation</a>--}}
{{--                        <a class="tag is-delete"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="columns">--}}
{{--        <div class="column"></div>--}}
{{--    </div>--}}
{{--    <h1 class="title">登録するハッシュタグ</h1>--}}
{{--    <div class="columns">--}}
{{--        @foreach($categories as $category)--}}
{{--        <div class="column">--}}
{{--            <form action="{{route('category.add', ['id' => $category->id])}}" method="post" >--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="category_key" value="{{$category->uuid}}">--}}
{{--                <input type="submit" value="{{$category->description}}" class="button is-primary is-light">--}}
{{--            </form>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    @endsection
</x-layout>

