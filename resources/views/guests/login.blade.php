@extends('layouts.default')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">ログイン</h1>
        <form method="post" action="{{ action('SessionController@login') }}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <p class="text-danger">*{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <br>
                <input class="form-control" type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <p class="text-danger">*{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="ログイン" class="btn btn-primary w-50">
            </div>
        </form>
        <p class="text-center"><a href="{{ action('RegisterController@create') }}">新規登録</a></p>
    </div>
@endsection
