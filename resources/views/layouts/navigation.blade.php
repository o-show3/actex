<h3 class="uk-card-title">メニュー</h3>
<div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
    <div>
        <a class="uk-link-text" href="{{route('users.pair')}}">
            <div class="uk-card uk-card-primary uk-card-body uk-card-hover">
                <h3 class="uk-card-title">マッチング</h3>
                <p>相互にマッチングを行う機能</p>
            </div>
        </a>
    </div>
    <div>
        <a class="uk-link-text" href="{{route('category.top')}}">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title">興味</h3>
                <p>興味のあるジャンルを選択します</p>
            </div>
        </a>
    </div>
    <div>
        <a class="uk-link-text" href="{{route('message.top')}}">
            <div class="uk-card uk-card-secondary uk-card-body uk-card-hover">
                <h3 class="uk-card-title">メッセージ</h3>
                <p>マッチングした人同士でメッセージをやり取りすることができます</p>
            </div>
        </a>
    </div>
</div>
