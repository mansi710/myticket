<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Notification as Notification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data = ([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        Log::info('Test before notify');

        // dd($user);
        // $user->notify(new RegisteredUserNotification($data));

        // return $user;

        $admins=User::get();

        Notification::send($admins,new RegisteredUserNotification($user));
        Log::info('Test after notify');


        // event(new Registered($user));

        Auth::login($user);
        Log::info('Test after auth');
        return redirect(RouteServiceProvider::HOME);
    }
}
