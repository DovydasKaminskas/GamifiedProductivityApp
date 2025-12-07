<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TodaysProgressService;
use App\Services\UserLevelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use App\Services\AchievementService;

class AuthController extends Controller
{
    public function showRegister () {
        return view('auth.register');
    }
    public function showLogin () {
        return view('auth.login');
    }

    public function register (Request $request,  AchievementService $achievementService) {
        $validated = $request->validate([
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
        ]);
        $validated['last_login'] = now();
        $validated['day_streak'] = 1;
        $user = User::create($validated);
        $achievementService->createAchievementsForUsers($user);
        $achievementService->alwaysOn($user);

        $user->save();
        Auth::login($user);

        return redirect()->route('show.dashboard');
    }
    public function login (Request $request) {
        $validated = $request->validate([
            'emailOrUsername' => 'required',
            'password' => 'required|string',
        ]);
        $firstCredentialValue = $validated['emailOrUsername'];
        $firstCredentialValueType = filter_var($firstCredentialValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$firstCredentialValueType => $firstCredentialValue, 'password' => $validated['password']];
        if (Auth::attempt($credentials, isset($validated['remember']))) {
            $request->session()->regenerate();
            $user = Auth::user();
            /** @var \App\Models\User $user */
            $user->save();

            return redirect()->route('show.dashboard');
        }

        throw ValidationException::withMessages([
            'credentials' => 'The email, username or password is incorrect'
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.index');

    }
}
