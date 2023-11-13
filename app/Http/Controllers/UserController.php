<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        return view('user.show', compact('user'));
    }

    public function update(UserUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $user = $request->user();
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('user.id', $user->id);

        return redirect()->back();
    }
}
