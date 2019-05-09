<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return Auth::check()
            ? $this->recipes()
            : $this->welcome();
    }

    /**
     * @return \Illuminate\View\View
     */
    protected function recipes(): View
    {
        $recipes = Recipe::latest()->paginate(5);
        return view('recipes.index')
            ->with(compact('recipes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|View
     */
    protected function welcome()
    {
        return view('guests.index');
    }
}
