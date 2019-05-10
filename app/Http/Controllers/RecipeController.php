<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Recipe;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class RecipeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('recipes.create',['user' => Auth::user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function confirm(Request $request)
    {
        if ($response = $this->validateRecipeThenFailed($request, $tags)) {
            return $response;
        }

        $user = Auth::user();

        return view('recipes.confirm')
            ->with(compact('request', 'tags', 'user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($response = $this->validateRecipeThenFailed($request, $tags)) {
            return $response;
        }

        // レシピ作成

        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->ingredient = $request->input('ingredient');
        $recipe->method = $request->input('method');

        // ユーザーテーブルカラム値取得
        $recipe->user()->associate(Auth::user());

        // DBトランザクション処理
        DB::transaction(function () use ($recipe, $tags) {
            foreach ($tags as $title) {
                // 既存でないタグの新規作成
                $tag = Tag::firstOrCreate(['title' => $title]);
                $recipe->save();
                $recipe->tags()->attach($tag);
            }
        });
        //2重送信防止
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * @param Recipe $recipe
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(Recipe $recipe): View
    {
        return view('recipes.show')
            ->with(compact('recipe'));
    }

    /**
     * @param Recipe $recipe
     * @return View
     */
    public function edit(Recipe $recipe): View
    {
        $this->authorize('edit', $recipe);

        $editTags = '';

        foreach ($recipe->tags as $tag) {
            $editTags .= $tag->title . ',';
        }

        return view('recipes.edit')
            ->with(compact('recipe', 'editTags'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('edit', $recipe);

        if ($response = $this->validateRecipeThenFailed($request, $tags)) {
            return $response;
        }

        if ($response = $this->validateRecipeImage($request, $recipe)) {
            return $response;
        }

        $recipeImage = $request->file('recipe-image');

        if ($recipeImage) {
            //640×640にリサイズ
            Image::make($recipeImage)
                ->resize(640, 640)
                ->save(storage_path("app/public/recipeImages/recipe-{$recipe->id}"));

            $recipe->recipeImage = "storage/recipeImages/recipe-{$recipe->id}";
        }

        // 更新
        $recipe->title = $request->input('title');
        $recipe->ingredient = $request->input('ingredient');
        $recipe->method = $request->input('method');

        $recipe->save();

        //2重送信防止
        $request->session()->regenerateToken();

        return redirect()
            ->action('RecipeController@show', $recipe);
    }

    /**
     * @param Request $request
     * @param array $tags
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function validateRecipeThenFailed(Request $request, &$tags)
    {
        $rules = [
            'title' => 'required|max:50',
            'ingredient' => 'required|max:500',
            'method' => 'required|max:1000',
            'tags' => 'array|max:10',
            'tags.*' => 'string|max:10',
        ];

        $tags = array_filter(explode(",", $request->input('tags')), "strlen");
        $inputs = array_replace($request->all(), compact('tags'));

        $validator = Validator::make($inputs, $rules, [
            'tags.*' => [
                'array' => 'タグは10個までです。',
                'string' => 'タグは10文字以下のみ有効です。',
            ],
        ]);

        if ($validator->fails()) {
            return redirect('/recipes/create')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function validateRecipeImage(Request $request)
    {
        $rules = ['recipe-image' => 'nullable|file|mimes:jpeg,png,gif'];

        $validator = Validator::make($request->only('recipe-image'), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}
