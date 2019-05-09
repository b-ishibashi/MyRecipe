@extends('layouts.default')

@section('content')
    <div class="wrapper p-5">
        <div class="d-flex flex-column align-items-center">
            <h1 class="text-center pb-4" style="font-family: Hannari">みんなのレシピ</h1>
            <div class="pagination pb-3">{{ $recipes->links() }}</div>
            <div class="recipe-list d-flex justify-content-center flex-wrap pb-3">
                @foreach($recipes as $recipe)
                    @component('components.recipe-card', compact('recipe'))
                    @endcomponent
                @endforeach
            </div>
            <div class="pagination">{{ $recipes->links() }}</div>
        </div>
    </div>
@endsection
