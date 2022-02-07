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
                    @for($i=0;$i<=34;$i++)
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-hash"></i>
                            Hashtag
                        </button>
                    @endfor
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
    {{--    <div class="columns">--}}
    {{--        <div class="column is-full">--}}
    {{--            <h1 class="title">最近の気になる話題</h1>--}}
    {{--            <h2 class="subtitle">最近のニュースをピックアップ！</h2>--}}
    {{--            <table class="table">--}}
    {{--                <thead>--}}
    {{--                    <tr>--}}
    {{--                        <th>公開日</th>--}}
    {{--                        <th>タイトル</th>--}}
    {{--                        <th>内容</th>--}}
    {{--                    </tr>--}}
    {{--                </thead>--}}
    {{--                <tbody>--}}
    {{--                    <tr>--}}
    {{--                        <td>2022-01-31T11:53:49Z</td>--}}
    {{--                        <td>弊社所属タレント越岡裕貴（ふぉ〜ゆ〜）・横原悠毅（IMPACTors） 新型コロナウイルス感染に関するご報告 | Johnny & Associates - ジャニーズ事務所</td>--}}
    {{--                        <td>ジャニーズ事務所公式企業サイト。ごあいさつ、ロゴに込めた想い、会社概要、沿革、グループ会社一覧、お知らせなどジャニーズ事務所の企業情報を掲載しております。</td>--}}
    {{--                    </tr>--}}
    {{--                    <tr>--}}
    {{--                        <td>2022-01-31T11:53:49Z</td>--}}
    {{--                        <td>1時間に約3回の電波放射を繰り返す「未知の天体」約4000光年先に発見 - sorae 宇宙へのポータルサイト</td>--}}
    {{--                        <td>カーティン大学／国際電波天文学研究センター（ICRAR）のNatasha Hurley-Walkerさんを筆頭とする研究グループは、強い電波放射を繰り返す未知の天体が天の川銀河の中で見つかったとする研</td>--}}
    {{--                    </tr>--}}
    {{--                </tbody>--}}
    {{--            </table>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    @endsection
</x-layout>

