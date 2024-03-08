<?php

namespace App\Http\Controllers;

Use Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'type' => 'required|in:voter,admin' // Validate the type field
    ]);

    $credentials = $request->only('email', 'password');
    $type = $request->input('type');

    if (auth()->attempt($credentials, $request->filled('remember'), ($type === 'admin') ? 'users' : 'voters')) {
        // Redirect to the appropriate dashboard based on user type
        if ($type === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('voter.dashboard');
        }
    }

    throw ValidationException::withMessages([
        'email' => 'Your provided credentials could not be verified.'
    ]);
}

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
        
    }

    public function update(){
        
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]); 
          
        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
