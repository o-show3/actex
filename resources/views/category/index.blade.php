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
                    @foreach($newCategories as $newCategory)
                        <form action="{{route('category.add')}}" method="post" style="display: inline">
                            @csrf
                            <input type="hidden" name="category_key" value="{{$newCategory->uuid}}">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-hash"></i>
                                {{$newCategory->description}}
                            </button>
                        </form>
                    @endforeach
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
                    @foreach($userCategories as $userCategory)
                        <button class="btn btn-outline-danger" data-bs-toggle="modal"  data-bs-target="#modal-delete{{$userCategory->category->uuid}}">
                            <i class="bi bi-hash"></i>
                            {{$userCategory->category->description}}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-delete{{$userCategory->category->uuid}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">確認</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ハッシュタグ「{{$userCategory->category->description}}」の登録を解除します。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                                        <form action="{{route('category.delete')}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="category_key" value="{{$userCategory->category->uuid}}">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-x"></i>
                                                はい
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-layout>

