<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        return view(' website.pages.Profiles.TrainerProfile.create', compact('user'));
    }
   
    public function store(Request $request)
    { 
        $user = Auth::user();
        
        $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $user->id,
            'specialization' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'followers_count' => 'nullable|integer',
            'private_classes_count' => 'nullable|integer',
            'group_classes_count' => 'nullable|integer',
            'certifications' => 'nullable|string',
        ]);

        $trainerData = $request->only([
            'specialization',
            'bio',
            'rating',
            'classes_count',
            'followers_count',
            'private_classes_count',
            'group_classes_count',
            'certifications',
        ]);

        $trainerData['create_user_id'] = $user->id;

        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->file('profile_picture')->storeAs('public/trainers', $imageName);
            $trainerData['profile_picture'] = $imageName;
        }

        Trainer::create($trainerData);

        if ($request->filled('email') && $request->filled('fullname')) {
            $user->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
            ]);
        } else {
            return redirect()->back()->withErrors(['email' => 'Email and Fullname are required']);
        }

        return redirect()->route('trainerprofile.show', ['id' => $user->id])->with('success', 'Trainer profile created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $trainerProfile = Trainer::where('create_user_id', $user->id)->first();

        return view(' website.pages.Profiles.TrainerProfile.show', compact('user', 'trainerProfile'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $trainerProfile = Trainer::where('create_user_id', $user->id)->firstOrFail();

        return view('website.pages.Profiles.TrainerProfile.edit', compact('user', 'trainerProfile'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $trainerProfile = Trainer::where('create_user_id', $user->id)->firstOrFail();

        $request->validate([
            'specialization' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'followers_count' => 'nullable|integer',
            'private_classes_count' => 'nullable|integer',
            'group_classes_count' => 'nullable|integer',
            'certifications' => 'nullable|string',
        ]);

        $trainerProfile->update([
            'specialization' => $request->specialization,
            'bio' => $request->bio,
            'rating' => $request->rating,
            'followers_count' => $request->followers_count,
            'private_classes_count' => $request->private_classes_count,
            'group_classes_count' => $request->group_classes_count,
            'certifications' => $request->certifications,
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($trainerProfile->profile_picture) {
                $oldImagePath = storage_path('app/public/trainers/' . $trainerProfile->profile_picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->file('profile_picture')->storeAs('public/trainers', $imageName);

            $trainerProfile->update(['profile_picture' => $imageName]);
        }

        return redirect()->route('trainerprofile.show', ['id' => $user->id])->with('success', 'Trainer profile updated successfully.');
    }
   
    
}
