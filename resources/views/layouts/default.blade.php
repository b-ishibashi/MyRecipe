<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>My Recipe</title>

</head>
<body>
<header>
    @auth
        @component('components.nav-bar', ['menu' => [
            action('RecipeController@create') => 'レシピをつくる',
            action('UserController@show', Auth::user()) => 'プロフィール',
        ], compact('q')])
        @endcomponent
    @endauth
    @guest
        @component('components.nav-bar', ['menu' => [
            action('IndexController@index') => 'Home',
            action('SessionController@login') => 'ログイン',
            action('RegisterController@create') => '新規登録',
        ]])
        @endcomponent
    @endguest
</header>
<main>
    @yield('content')
</main>
<footer class="footer">
    <div class="container">
        <p class="text-muted text-center border border-bottom-0 border-right-0 border-left-0 pt-3 mt-3">Copyright © 2019 Ishibashi. All Rights Reserved.</p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@stack('script')

</body>
</html>
