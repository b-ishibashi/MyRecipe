@extends('layouts.default')

@section('content')
    <div class="wrapper p-5">
        <h1 class="pb-5 text-center" style="font-family: Hannari">プロフィール</h1>
        <div class="profile-card d-flex flex-column align-items-center pb-5">
            <div class="user-avatar pb-3">
                <img src="{{ asset($user->avatar) }}" class="rounded-circle border" width="180" height="180">
            </div>
            <aside class="pb-2">{{ $user->name }}</aside>
            <a class="btn btn-primary" href="{{ action('UserController@edit', $user) }}">設定</a>
        </div>
        <div class="profile-nav">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="recipes-tab" data-toggle="tab" href="#recipes" role="tab" aria-controls="recipes" aria-selected="true"><span style="font-family: Hannari">レシピ</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false"><span style="font-family: Hannari">コメント</span></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active d-flex flex-column align-items-center" id="recipes" role="tabpanel" aria-labelledby="recipes-tab">
                    <h1 class="py-5">{{ $user->name }}<span style="font-family: Hannari"> さんのレシピ</span></h1>
                    <div class="pagination">{{ $user->getRecipes(6)->links() }}</div>
                    <div class="my-recipe-list d-flex flex-wrap justify-content-center">
                        @foreach($user->getRecipes(6) as $recipe)
                            @component('components.recipe-card', compact('recipe'))
                            @endcomponent
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade d-flex align-items-center flex-column" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                    <h1 class="py-5">{{ $user->name }}<span style="font-family: Hannari"> さんのコメント</span></h1>
                    <div class="pagination pb-2">{{ $user->getComments(5)->links() }}</div>
                    <div class="recipe-comments d-flex flex-column align-items-start">
                        @foreach($user->getComments(5) as $comment)
                            @component('components.comment-card', compact('comment'))
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

