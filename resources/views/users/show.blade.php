@extends('layouts.default')

@section('content')
    <div class="wrapper p-5">
        <h1 class="pb-5 text-center" style="font-family: Hannari">プロフィール</h1>
        <div class="profile-card d-flex flex-column align-items-center pb-5">
            <div class="user-avatar pb-3">
                <img src="{{ asset($user->avatar) }}" class="rounded-circle border" width="180" height="180">
            </div>
            <aside>{{ $user->name }}</aside>
        </div>
        <h1 class="pb-5 text-center">{{ $user->name }}<span style="font-family: Hannari"> さんのレシピ</span></h1>
        <div class="my-recipe-list d-flex flex-wrap justify-content-center">
            @foreach($user->recipes as $recipe)
                @component('components.recipe-card', compact('recipe'))
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
