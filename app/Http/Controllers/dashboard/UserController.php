<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::orderBy('id', 'asc')->simplePaginate(5);
        return view('dashboard.pages.User.indexs.index', compact('Users'));
    }

    public function customersIndex()
    {
        $customers = User::where('user_type', 'customer')->simplePaginate(5);
        $customers_count = $customers->count();
        return view('dashboard.pages.User.indexs.customersIndex', compact('customers', 'customers_count'));
    }

    public function trainerIndex()
    {
        $trainers = User::where('user_type', 'trainer')->simplePaginate(5);
        $trainers_count = $trainers->count();
        return view('dashboard.pages.User.indexs.trainerIndex', compact('trainers', 'trainers_count'));
    }

    public function adminIndex()
    {
        $admins = User::where('user_type', 'admin')->simplePaginate(5);
        $admins_count = $admins->count();
        return view('dashboard.pages.User.indexs.adminIndex', compact('admins', 'admins_count'));
    }

    public function create()
    {
        return view('dashboard.pages.User.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'fullname'  => 'nullable|string',
            'username'  => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'user_type' => 'required|in:customer,trainer,admin',
            'phone'     => 'required|string|max:20|unique:users,phone',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if ($request->user_type === 'trainer') {
            $rules['specialization'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName);
            $data['image'] = $imageName;
        }

        $defaultPassword = $request->username . '123456789';
        $hashedPassword = bcrypt($defaultPassword);
        $data['password'] = $hashedPassword;
        $data['confirm_password'] = $hashedPassword;

        User::create($data);

        return redirect()->route('users.index')->with('Created_User_Sucessfully', "The user '{$request->username}' has been created successfully with default password.");
    }
    public function show(string $username)
    {
        // البحث عن المستخدم بناءً على الاسم
        $user = User::where('username', $username)->firstOrFail(); // Eloquent ORM

        if ($user == null) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        return view('dashboard.pages.User.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // البحث عن المستخدم بناءً على الـ id
        $user = User::findOrFail($id); // Eloquent ORM

        // التحقق من الصلاحيات
        if (auth()->user()->id == $user->id || auth()->user()->user_type == "admin") {
            
            return view('dashboard.pages.User.edit', compact('user'));
        } 
        elseif (auth()->user()->user_type == "admin" && $user->user_type != "admin" && auth()->user()->id != $user->id) 
        {
            return redirect()->route('users.index')->with('unauthorized_action', 'You are not authorized to perform this action.');
        }
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'fullname'  => 'nullable|string',
            'username'  => 'required|unique:users,username,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'user_type' => 'required|in:customer,trainer,admin',
            'phone'     => 'required|string|max:20|unique:users,phone,' . $id,
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if ($request->user_type === 'trainer') {
            $rules['specialization'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($user->image) {
                $oldImagePath = storage_path('app/public/profiles/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName);
            $data['image'] = $imageName;
        }

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('Updated_User_Sucessfully', "The user '{$request->username}' has been updated successfully.");
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->user_type === "admin" && $user->user_type !== "admin" && auth()->user()->id !== $user->id) {
            $user->delete();
            return redirect()->route('users.index')->with('Deleted_User_Sucessfully', sprintf('User %s deleted successfully', $user->username));
        } else {
            return view('dashboard.pages.User.404.users-404');
        }
    }
}
