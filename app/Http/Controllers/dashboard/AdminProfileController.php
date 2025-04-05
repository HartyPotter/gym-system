<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Storage};
use App\Models\User;

class AdminProfileController extends Controller
{
    // Show user profile
public function show($username)
{
    $user = User::where('username', $username)->firstOrFail();
    return view('dashboard.pages.Profile.show', compact('user'));
}

 // Edit user profile
 public function edit($username)
 {
     $user = User::where('username', $username)->firstOrFail();
     return view('dashboard.pages.profile.edit', compact('user'));
 }

 // تحديث الملف الشخصي
 public function update(Request $request, $username)
 {
     $user = User::where('username', $username)->firstOrFail();

     // التحقق من صحة البيانات
     $request->validate([
         'fullname' => 'nullable|string|max:255',
         'username' => 'required|string|max:255|unique:users,username,' . $user->id,
         'email' => 'required|email|unique:users,email,' . $user->id,
         'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
         'gender' => 'nullable|in:male,female',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

    
     $user->update([
         'fullname' => $request->fullname,
         'username' => $request->username,
         'email' => $request->email,
         'phone' => $request->phone,
         'gender' => $request->gender,
     ]);

    
     if ($request->hasFile('image')) {
        
         if ($user->image) {
             $oldImagePath = storage_path('app/public/profiles/' . $user->image);
             if (file_exists($oldImagePath)) {
                 unlink($oldImagePath);
             }
         }

        
         $imageName = time() . '.' . $request->image->extension();
         $request->file('image')->storeAs('public/profiles', $imageName);

         $user->update(['image' => $imageName]);
     }

    
     return redirect()->route('admin.profile.show', ['username' => $user->username])
         ->with('success', 'Profile updated successfully.');
 }

 

}
