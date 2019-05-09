@extends('layouts.default')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">アカウント登録</h1>
        <form method="post" action="{{ action('RegisterController@store') }}">
            @csrf
            <div class="form-group">
                <label for="name">名前: (30文字以内)</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="text-danger">*{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <p class="text-danger">*{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">パスワード: (8文字以上)</label>
                <br>
                <input class="form-control" type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <p class="text-danger">*{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation">パスワード(確認用)</label>
                <br>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="登録" class="btn btn-primary w-50">
            </div>
        </form>
        <p class="text-center"><a href="{{ action('SessionController@login') }}">ログイン</a></p>
    </div>
@endsection
