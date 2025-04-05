<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscription;
use App\Events\CustomerRegistered; // استدعاء الحدث الذي أنشأته
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'gender' => 'required|in:male,female,prefer_not_to_say',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? 'prefer not to say',
            'user_type' => $data['user_type'] ?? 'customer',
        ]);

        // إطلاق الحدث بعد إنشاء المستخدم
        event(new CustomerRegistered($user));

        return $user;
    }

    public function redirectToLogin()
    {
        return redirect()->route('/login');
    }
}
