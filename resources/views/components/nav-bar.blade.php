<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top" style="box-shadow: 0 1px 3px #9ba2ab; border-radius: 1px">
    <a class="navbar-brand" href="{{ action('IndexController@index') }}"><strong>My Recipe</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            @foreach($menu as $href => $title)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ $href }}">{{ $title }}</a>
                </li>
            @endforeach
        </ul>
        @auth
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ action('SessionController@logout') }}">ログアウト</a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
