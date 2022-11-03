<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product_category;

class UserController extends Controller
{
    // Show Register Form
    public function create()
    {
        return view('users.register', ['categories' => Product_category::get()]);
    }

    // Create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email_address' => ['required', 'email', Rule::unique('users', 'email_address')],
            'phone_number' => ['required', 'min:10', 'max:11', Rule::unique('users', 'phone_number')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create new user
        $user = User::create($formFields);


        // Add role "user" for user
        User_role::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);

        //Login 
        auth()->login($user);

        return redirect('/')->with('message', "Đăng ký tài khoản mới thành công");
    }

    public function login()
    {
        return view('users.login', ['categories' => Product_category::get()]);
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email_address' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email_addrress' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show edit user view
    public function edit()
    {
        return view('users.manage');
    }
}
