<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Policies\CommentPolicy;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $this->authorize('store', [Comment::class, $recipe]);

        $rules = [
            'body' => 'required|max:200',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user()->associate(Auth::user());
        $comment->recipe()->associate($recipe);
        $comment->save();

        // 2重送信防止
        $request->session()->regenerateToken();

        return redirect()
            ->action('RecipeController@show', $recipe);
    }
}
