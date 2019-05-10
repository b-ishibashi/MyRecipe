@extends('layouts.default')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">設定</h1>
        <form class="form-group" method="post" action="{{ action('UserController@update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="avatar pb-2 text-center">
                <label class="avatar text-center position-relative" style="width: 180px; height: 180px">
                    <p class="click-to-upload-avatar">画像を変更</p>
                    <img src="{{ asset($user->avatar) }}" class="rounded-circle border" width="180" height="180">
                    <input type="file" name="avatar" style="visibility: hidden; width: 0; height: 0">
                </label>
            </div>
            <div class="name">
                <label for="name">名前: (30文字以内)</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}">
                @if ($errors->has('name'))
                    <p class="text-danger">*{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="email">
                <label for="email">メールアドレス</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}">
                @if ($errors->has('email'))
                    <p class="text-danger">*{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="old_password">
                <label for="old_password">現在のパスワード</label>
                <br>
                <input class="form-control" type="password" name="old_password" id="old_password">
                @if ($errors->has('old_password'))
                    <p class="text-danger">*{{ $errors->first('old_password') }}</p>
                @endif
            </div>
            <div class="new_password">
                <label for="new_password">新しいパスワード: (8文字以上) *変更しない場合は未入力で構いません。</label>
                <br>
                <input class="form-control" type="password" name="new_password" id="new_password">
                @if ($errors->has('new_password'))
                    <p class="text-danger">*{{ $errors->first('new_password') }}</p>
                @endif
            </div>
            <div class="new_password-confirm pb-3">
                <label for="password_confirmation">新しいパスワード(確認用)</label>
                <br>
                <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation">
                @if ($errors->has('new_password_confirmation'))
                    <p class="text-danger">{{ $errors->first('new_password_confirmation') }}</p>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="更新する" class="btn btn-primary w-50">
            </div>
        </form>
        <p class="text-center">
            <a href="{{ action('UserController@show', $user) }}">戻る</a>
        </p>
    </div>
@endsection

@push('script')
    <script>
        $(function () {
            'use strict';

            $('.avatar input').change(function(e) {
                const url = URL.createObjectURL(e.target.files[0]);
                $('.avatar img').attr('src', url);
            });
        });
    </script>
@endpush
