@extends('layouts.default')

@section('content')
    <div class="p-5">
        <div class="d-flex flex-column align-items-center">
            <h1 class="pb-5">{{ $recipe->title }}</h1>
            <div class="recipe-show-card d-flex flex-column align-items-start border p-3">
                <div class="d-flex justify-content-center align-self-center">
                    <div class="p-2">
                        <img src="{{ asset($recipe->recipeImage) }}" class="rounded-circle" width="256" height="256">
                    </div>
                    <div class="edit-recipe d-flex flex-column align-self-end">
                        <a href="{{ action('RecipeController@edit', $recipe) }}">編集する</a>
                    </div>
                </div>
                <div class="ingredient p-2">
                    <div class="d-flex flex-column p-2">
                        <div class="pb-1 border border-right-0 border-left-0 border-top-0" style="font-weight: bold; width: 100%;">材料</div>
                        <div class="pt-1 align-self-center">{!! nl2br(e($recipe->ingredient)) !!}</div>
                    </div>
                </div>
                <div class="method p-2">
                    <div class="d-flex flex-column p-2" style="background: #EEEEEE; border-radius: 6px">
                        <div class="pb-1 border border-top-0 border-left-0 border-right-0" style="font-weight: bold; width: 100%">手順</div>
                        <div class="pt-1">{!! nl2br(e($recipe->method)) !!}</div>
                    </div>
                </div>
                <div class="p-2">
                    @component('components.tag-card', compact('recipe'))
                    @endcomponent
                </div>
                <div class="d-flex justify-content-between p-2 w-100">
                    <a class="d-flex" href="{{ action('UserController@show', $recipe->user) }}">
                        <img src="{{ asset($recipe->user->avatar) }}" class="rounded-circle border" width="32" height="32">
                        <aside class="pl-3">{{ $recipe->user->name }}</aside>
                    </a>
                    <a href="//twitter.com/share" class="twitter-share-button" data-text="[MyRecipe] 「{{ $recipe->title }}」 {{ $recipe->user->name }}さんより" data-lang="ja"></a>
                </div>
            </div>
            <div class="comments py-5" style="width: 600px;">
                <h2 class="pb-5">コメント（{{ count($recipe->comments) }}件）</h2>
                <div class="recipe-comments d-flex flex-column align-items-start">
                    <div class="pagination align-self-center">{{ $recipe->getComments(5)->links() }}</div>
                    @foreach($recipe->getComments(5) as $comment)
                        @component('components.comment-card', compact('comment'))
                        @endcomponent
                    @endforeach
                    <p class="pt-3" style="margin: 0">コメントを書く</p>
                </div>
                <form class="form-group" method="post" action="{{ action('CommentController@store', $recipe) }}">
                    @csrf
                    <textarea class="form-control mb-3" name="body" rows="2" cols="200">{{ old('body') }}</textarea>
                    @if ($errors->has('body'))
                        <p class="text-danger text-small">*{{ $errors->first('body') }}</p>
                    @endif
                    <div class="text-center">
                        <input class="btn btn-primary w-50" type="submit" value="回答する" id="send-comment">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function (){
            'use strict';

            $('#send-comment').submit(function() {
                if (confirm('本当に送信しますか？')) {
                    $(this).val('submit');
                } else {
                    return false;
                }
            });
        });
    </script>
@endpush
