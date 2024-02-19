<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // login section
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard')
                ->with('success', 'You have Successfully loggedin.');
        }

        return redirect("login")->with('error', 'Oppes! You have entered invalid credentials.');
    }

    // signup section
    public function signup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $data = $request->all();

        try {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // User already exists
                throw new \Exception('The email address is already in use.');
            }

            // Create the user if it doesn't exist
            $check = $this->create($data);

            if ($check) {
                return redirect("login")->with('success', 'Great! Sign up completed, now you can login.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => hash::make($data['password'])
        ]);
    }

    // logout section
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login')->with('success', 'You have been successfully logged out.');
    }
}
