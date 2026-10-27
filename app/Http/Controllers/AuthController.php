<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\LoginReq;
use App\Http\Requests\StoreRegister;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    

    public function showRegisterPage()
    {
        return view('components.register');
    }

    public function showLoginPage()
    {
        return view('components.login');
    }

    public function showHistoryPage()
    {
        $orders = Order::with('items.product')->where('user_id', auth()->id())->latest()->get();
        return view('components.history', compact('orders'));
    }

    public function register(StoreRegister $validate)
    {
        $user = User::create($validate-> validated());

        Auth::login($user);

        return redirect('/');
    }

    public function login(LoginReq $validate)
    {
        $validated = $validate -> validated();

        if (Auth::attempt($validated)){
            $validate->session()->regenerate();

            return redirect()->intended('/');

        }

        throw ValidationException::withMessages([
            'credintials' => 'Sorry, Incorrect credintials'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');

    }
}
