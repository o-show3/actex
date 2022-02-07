<x-layout>
    @section('title')
        ダッシュボード
    @endsection
    @section('subtitle')
        ようこそ！
    @endsection
    @section('content')
    <div class="m-1">
        <h1 class="display-6">トレンドハッシュタグ</h1>
        <p class="lead">最近トレンドなハッシュタグを見つけましょう！</p>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    @foreach($trendCategoryCollection as $trendCategory)
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-hash"></i>
                            {{$trendCategory->description}}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h1 class="display-6">最近の気になる話題</h1>
        <p class="lead">最近のニュースをピックアップ！</p>
        <div class="container-fluid">
            <div class="row">
                @foreach($topicCollection as $topic)
                    <div class="col-3 mb-3">
                        <div class="card" style="height: 500px ;">
                            <img src="{{$topic->url_to_image}}" class="card-img-top mx-auto" style="object-fit: contain;width: 75%;height: 100px">
                            <div class="card-body">
                                <h5 class="card-title">{{$topic->title}}</h5>
                                <p class="card-text">
                                    {{ Str::limit($topic->description, 280, '...') }}
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{$topic->url}}"  target="_blank" type="button" class="btn btn-primary"><i class="bi bi-door-open"></i>開く</a>
                                    @if(in_array($topic->id, $userTopicsList))
                                        <span class="btn btn-outline-primary">気になる！済み</span>
                                    @else
                                        <a class="btn btn-primary" href="{{route('topics.topic-like', $topic->uuid)}}">
                                            気になる！
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection
</x-layout>

