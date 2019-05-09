<article class="recipe-card d-flex flex-column align-items-center border mb-3 mr-3 p-3">
    <img src="{{ asset($recipe->recipeImage) }}" class="rounded-circle" width="256" height="256">
    <div class="d-flex flex-column align-items-start pt-3" style="width: 256px;">
        <div class="align-self-center pb-3"><a href="{{ action('RecipeController@show', $recipe) }}">{{ $recipe->title }}</a></div>
        @component('components.tag-card', compact('recipe'))
        @endcomponent
        <a class="d-flex" href="{{ action('UserController@show', $recipe->user) }}">
            <img src="{{ asset($recipe->user->avatar) }}" class="rounded-circle border" width="32" height="32">
            <aside class="pl-3">{{ $recipe->user->name }}</aside>
        </a>
    </div>
</article>


