<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        return view('guests.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        // validate
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        // ログイン検証
        if (!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        //2重送信防止
        $request->session()->regenerate();

        //ログインメッセージセット
        session()->flash('login', 'ログインしました');

        return redirect()->intended('/');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
