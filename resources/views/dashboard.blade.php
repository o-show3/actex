<x-layout>
    @section('title')
        ダッシュボード
    @endsection
    @section('subtitle')
        ようこそ！
    @endsection
    @section('content')
    <div class="columns">
        <div class="column">
            <h1 class="title">最近のトレンドタグ</h1>
            <h2 class="subtitle">最近の熱い！トレンドタグ</h2>
            <div class="field is-grouped is-grouped-multiline">
                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Technology</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">CSS</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Flexbox</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Web Design</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Open Source</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Community</a>
                    </div>
                </div>

                <div class="control">
                    <div class="tags has-addons">
                        <a class="tag is-link">Documentation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column"></div>
    </div>
    <div class="columns">
        <div class="column is-full">
            <h1 class="title">最近の気になる話題</h1>
            <h2 class="subtitle">最近のニュースをピックアップ！</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>公開日</th>
                        <th>タイトル</th>
                        <th>内容</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2022-01-31T11:53:49Z</td>
                        <td>弊社所属タレント越岡裕貴（ふぉ〜ゆ〜）・横原悠毅（IMPACTors） 新型コロナウイルス感染に関するご報告 | Johnny & Associates - ジャニーズ事務所</td>
                        <td>ジャニーズ事務所公式企業サイト。ごあいさつ、ロゴに込めた想い、会社概要、沿革、グループ会社一覧、お知らせなどジャニーズ事務所の企業情報を掲載しております。</td>
                    </tr>
                    <tr>
                        <td>2022-01-31T11:53:49Z</td>
                        <td>1時間に約3回の電波放射を繰り返す「未知の天体」約4000光年先に発見 - sorae 宇宙へのポータルサイト</td>
                        <td>カーティン大学／国際電波天文学研究センター（ICRAR）のNatasha Hurley-Walkerさんを筆頭とする研究グループは、強い電波放射を繰り返す未知の天体が天の川銀河の中で見つかったとする研</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</x-layout>

