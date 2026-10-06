<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Passport sends signed-out users here before the approval screen
Route::get('/login', fn () => view('login'))->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        // Back to the approval screen the user came from
        return redirect()->intended('/');
    }

    // Wrong details: back to the form with an error
    return back()->withErrors(['email' => 'Wrong email or password.']);
});
