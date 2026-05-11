<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PensilController;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pensil;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::view('/login','auth.login')->name('login');

Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::post('/profile/password',[AuthController::class,'updatePassword'])->name('profile.password');
Route::post('/profile/photo',[AuthController::class,'uploadPhoto'])->name('profile.photo');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| REDIRECT ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| HOME (AUTO SPLIT ROLE)
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {

    if(auth()->user()->role === 'admin'){
        return redirect('/dashboard');
    }

    return redirect('/user/home');

})->middleware('auth')->name('home');

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search', function (Request $request) {

    $q = $request->q;

    $bukus = Buku::where('judul','like',"%$q%")
        ->orWhere('pengarang','like',"%$q%")
        ->get();

    $pensils = Pensil::where('nama','like',"%$q%")
        ->orWhere('warna','like',"%$q%")
        ->get();

    return view('search', compact('bukus','pensils','q'));

})->middleware('auth')->name('search');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/buku', [BukuController::class,'index'])->name('buku.index');
    Route::get('/pensil', [PensilController::class,'index'])->name('pensil.index');

    Route::middleware('admin')->group(function () {
        Route::resource('buku', BukuController::class)->except(['index']);
        Route::resource('pensil', PensilController::class)->except(['index']);
    });

});

/*
|--------------------------------------------------------------------------
| USER (FRONTEND MODE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('user')->group(function () {

    Route::get('/home', function () {
        return view('user.home');
    });

    Route::get('/dashboard', function () {
        return view('user.dashboard', [
            'totalBuku' => Buku::count(),
            'totalPensil' => Pensil::count()
        ]);
    });

    Route::get('/buku', function () {
        return view('user.buku', [
            'bukus' => Buku::all()
        ]);
    });

    Route::get('/pensil', function () {
        return view('user.pensil', [
            'pensils' => Pensil::all()
        ]);
    });

    Route::get('/profile', function () {
        return view('user.profile');
    });

});