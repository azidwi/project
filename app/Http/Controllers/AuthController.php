<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return back()->with('error', 'Email atau password salah');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:3',
        'confirm_password' => 'required|same:new_password'
    ]);

    $user = Auth::user();

    if(!Hash::check($request->current_password, $user->password)){
        return back()->with('error','Password lama salah');
    }

    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return back()->with('success','Password berhasil diubah');
}
    public function uploadPhoto(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $path = $request->file('foto')->store('profile','public');

    $user = Auth::user();
    $user->foto = $path;
    $user->save();

    return back();
}
}