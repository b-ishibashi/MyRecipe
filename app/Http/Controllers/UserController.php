<?php

namespace App\Http\Controllers;

use App\Rules\Oldpassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

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

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        // ユーザー情報のアップデート権限を確認
        $this->authorize('update', $user);
        return view('users.edit')
            ->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // ユーザー情報のアップデート権限を確認
        $this->authorize('update', $user);

        $avatar = $request->file('avatar');

        $rules = [
            'name' => 'required|string|max:30|unique:users,name,' . Auth::user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'old_password' => ['required', new Oldpassword($request)],
            'new_password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|file|mimes:jpeg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules, [], [
            'old_password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($avatar) {
            Image::make($avatar)
                ->resize(640, 640)
                ->save(storage_path("app/public/avatars/user-{$user->id}"));

            $user->avatar = "storage/avatars/user-{$user->id}";
        }

        $user->fill($request->only('name', 'email'));

        if ($request->input('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        $user->save();

        //2重送信防止
        $request->session()->regenerateToken();

        return redirect()
            ->action('UserController@show', $user);
    }

    public function delete(User $user)
    {
        User::destroy($user->id);

        return redirect()
            ->action('IndexController@index');
    }

}
