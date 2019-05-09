<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Compound;

class UserController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user): View
    {
        return view('users.show')
            ->with(compact('user'));
    }
}
