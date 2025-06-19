<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AuthController extends Controller
{
    public function showRegister () {
        return view('auth.register');
    }
    public function showLogin () {
        return view('auth.login');
    }

    public function register (Request $request) {
        $validated = $request->validate([
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $validated['last_login'] = now();
        $validated['day_streak'] = 1;
        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('show.index');
    }
    public function login (Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $user = Auth::user();

            $now = now();
            $diff = $now->diffInHours($user->last_login) * -1;
            if ($diff >= 24 && $diff < 48) {
                $user->day_streak++;
                $user->last_login = $now;
            } else if($diff >= 48) {
                $user->day_streak = 1;
                $user->last_login = $now;
            }
            $user->save();

            return redirect()->route('show.index');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect credentials'
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.index');

    }
}
