<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return Auth::check()
            ? $this->recipes($request)
            : $this->welcome();
    }

    /**
     * @return \Illuminate\View\View
     */
    protected function recipes(Request $request): View
    {
        $q = (string)$request->input('q');
        $maxKeywords = 10; // 適当な分割数の上限を設定（無制限にしたい場合は -1）
        $keywords = preg_split('/(?:\p{Z}|\p{Cc})++/u', $q, $maxKeywords, PREG_SPLIT_NO_EMPTY);

        $query = Recipe::query();

        foreach ($keywords as $keyword) {
            $query->where(function (Builder $query) use ($keyword) {
                $query
                    ->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('ingredient', 'like', '%' . $keyword . '%');
            });
        }

        $recipes = $query->latest()
            ->paginate(5)
            ->appends(compact('recipes', 'q'));

        return view('recipes.index')
            ->with(compact('recipes', 'q'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|View
     */
    protected function welcome()
    {
        return view('guests.index');
    }
}
