@extends('layouts.default')

@section('content')
    <div class="wrapper">
        <h3 class="p-5 text-center">この内容でよろしいですか？</h3>
            <div class="confirm-content d-flex flex-wrap justify-content-center">
                <img src="{{ asset('img/recipe-image.png') }}" class="rounded-circle" width="180" height="180">
                <div class="my-recipe px-5 pb-5 pt-3">
                    <table class="table">
                        <tr><th>タイトル</th><td>{{ $request->title }}</td></tr>
                        <tr><th>材料</th><td>{{ $request->ingredient }}</td></tr>
                        <tr><th>調理方法</th><td>{{ $request->method }}</td></tr>
                        @if($request->tags)
                            <tr><th>タグ</th><td class="d-flex flex-wrap">
                                    @foreach($tags as $tag)
                                        <span class="tag-style">{{ $tag }}</span>
                                    @endforeach
                                </td></tr>
                        @endif
                    </table>
                    <div class="send-confirm-content text-center">
                        <form method="post" action="{{ action('RecipeController@store') }}">
                            @csrf
                            <input type="hidden" name="title" value="{{ $request->title }}">
                            <input type="hidden" name="ingredient" value="{{ $request->ingredient }}">
                            <input type="hidden" name="method" value="{{ $request->method }}">
                            <input type="hidden" name="tags" value="{{ $request->tags }}">
                            <input class="btn btn-primary" type="submit" value="投稿する">
                            <a href="javascript:void(0)" onclick="history.back()">修正する</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
