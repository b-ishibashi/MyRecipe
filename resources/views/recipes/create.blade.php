@extends('layouts.default')

@section('content')
    <div class="wrapper">
        <h1 class="sub-title pt-5 text-center" style="font-family: Hannari">レシピをつくる</h1>
        <div class="p-5 d-flex flex-wrap justify-content-center" id="recipe-form">
            <div class="text-center px-4 d-flex align-items-center">
                <img src="{{ asset('img/recipe-image.png') }}" class="rounded-circle border border-white" width="180" height="180">
            </div>
            <form class="form-group recipe-form px-4" method="post" action="{{ action('RecipeController@confirm') }}" enctype="multipart/form-data">
                @csrf
                <label for="title">タイトル</label>
                <input class="form-control mb-2" type="text" name="title" placeholder="絶品！基本のペペロンチーノ" value="{{ old('title') }}" id="title">
                @if ($errors->has('title'))
                    <p class="text-danger text-small">*{{ $errors->first('title') }}</p>
                @endif
                <label for="ingredient">材料</label>
                <textarea class="form-control mb-2" name="ingredient" rows="4" cols="400" placeholder="塩: 大さじ1..." id="ingredient">{{ old('ingredient') }}</textarea>
                @if ($errors->has('ingredient'))
                    <p class="text-danger text-small">*{{ $errors->first('ingredient') }}</p>
                @endif
                <label for="method">調理方法</label>
                <textarea class="form-control mb-4" name="method" rows="6" cols="600" placeholder="1. パスタを茹でる..." id="method">{{ old('method') }}</textarea>
                @if ($errors->has('method'))
                    <p class="text-danger text-small">*{{ $errors->first('method') }}</p>
                @endif
                <label for="tags">タグ: (カンマ(半角)区切り, 10文字以下, 10個まで)</label>
                <input class="form-control mb-4" type="text" name="tags" value="{{ old('tags') }}" id="tags" placeholder="パスタ,ペペロンチーノ,...">
                @if ($errors->has('tags'))
                    <p class="text-danger text-small">*{{ $errors->first('tags') }}</p>
                @endif
                @if ($errors->has('tags.*'))
                    <p class="text-danger text-small">*{{ $errors->first('tags.*') }}</p>
                @endif
                <div class="text-center">
                    <input class="btn btn-primary w-50 mb-2" type="submit" value="次へ">
                    <p><a href="{{ action('IndexController@index') }}">戻る</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
