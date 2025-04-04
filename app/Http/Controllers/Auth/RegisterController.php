<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // This should match your actual view file location
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
    
    // Find the User role (assuming role ID 2 is for "User")
    $userRole = Role::find(2); // Use ID 2 based on your screenshot
    
    if ($userRole) {
        // Add the User role to this user
        $user->roles()->attach($userRole->id);
        \Log::info('User role attached: ' . $userRole->id . ' to user: ' . $user->id);
    } else {
        \Log::error('User role not found');
    }
    
    return $user;
}
    /**
     * Handle a registration request for the application.
     * Overriding this method to prevent auto-login after registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));
        
        // Don't auto-login - explicitly prevent it
        // $this->guard()->login($user); <- Comment out or remove this line if it exists
        
        return redirect()->route('login')
            ->with('status', 'Registration successful! Please login with your credentials.');
    }
    // In RegisterController.php
protected function registered(Request $request, $user)
{
    // Log out the user immediately after registration
    $this->guard()->logout();
    
    // Redirect with a message
    return redirect()->route('login')
        ->with('status', 'Registration successful! Please login with your credentials.');
}
}