<x-layout>
    @section('title')
        {{__('Function-Topic')}}
    @endsection
    @section('subtitle')
        気になるハッシュタグをみてみましょう！
    @endsection
    @section('content')
    <div class="mt-4">
        <h1 class="display-6">最近の気になる話題</h1>
        <p class="lead">最近のニュースをピックアップ！</p>
        <div class="container-fluid">
            <div class="row">
                @for($i=0;$i<=9;$i++)
                    <div class="col-4 mb-3">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">弊社所属タレント越岡裕貴（ふぉ〜ゆ〜）</h5>
                                <p class="card-text">
                                    ジャニーズ事務所公式企業サイト。ごあいさつ、ロゴに込めた想い、会社概要、沿革、グループ会社一覧、お知らせなどジャニーズ事務所の企業情報を掲載しております。
                                </p>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button target="_blank" type="button" class="btn btn-primary"><i class="bi bi-door-open"></i>開く</button>
                                    <button type="button" class="btn btn-primary"><i class="bi bi-bookmark-heart"></i>気になる</button>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                2022-01-31T11:53:49Z
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{{--        <div class="columns is-desktop">--}}
{{--            @foreach($topicCollection as $topic)--}}
{{--            <div class="column is-4">--}}
{{--                <div class="card">--}}
{{--                    <header class="card-header">--}}
{{--                        <p class="card-header-title">--}}
{{--                            Component--}}
{{--                        </p>--}}
{{--                        <button class="card-header-icon" aria-label="more options">--}}
{{--                            <span class="icon">--}}
{{--                                <i class="fas fa-angle-down" aria-hidden="true"></i>--}}
{{--                            </span>--}}
{{--                        </button>--}}
{{--                    </header>--}}
{{--                    <div class="card-content">--}}
{{--                        <div class="content">--}}
{{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.--}}
{{--                            <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>--}}
{{--                            <br>--}}
{{--                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <footer class="card-footer">--}}
{{--                        <a href="#" class="card-footer-item">Save</a>--}}
{{--                        <a href="#" class="card-footer-item">Edit</a>--}}
{{--                        <a href="#" class="card-footer-item">Delete</a>--}}
{{--                    </footer>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endforeach--}}
{{--        <div>--}}
{{--        </div>--}}
{{--        <div class="columns">--}}
{{--            <div class="column is-full">--}}

{{--            </div>--}}
{{--        </div>--}}
    @endsection
</x-layout>


{{--@foreach($topicCollection as $topic)--}}
{{--    <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mb-4 border-solid" >--}}
{{--        <img class="h-40" src="{{$topic->url_to_image}}">--}}
{{--        <a href="{{$topic->url}}" target="_blank" >{{$topic->title}}</a>--}}
{{--        <div class="buttons">--}}
{{--            @if(in_array($topic->id, $userTopicsList))--}}
{{--                <span>気になる！済み</span>--}}
{{--            @else--}}
{{--                --}}{{-- 気になる --}}
{{--                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('topics.topic-like', $topic->uuid)}}">--}}
{{--                    気になる！--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endforeach--}}
