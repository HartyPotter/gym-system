<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ProfileUser;
use App\Models\User;
use App\Models\BookedSession;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('website.pages.Profiles.Userprofile.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'fullname' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'image' => 'nullable|image|max:2048',
            'membership' => 'nullable|string|max:255',
            'body_fats_percentage' => 'nullable|numeric',
            'muscle_mass_percentage' => 'nullable|numeric',
            'water_percentage' => 'nullable|numeric',
            'bone_mass_percentage' => 'nullable|numeric',
            'other_composition_percentage' => 'nullable|numeric',
            'cardio_percentage' => 'nullable|numeric|min:0|max:100',
            'daily_goal_percentage' => 'nullable|numeric|min:0|max:100',
            'calories_percentage' => 'nullable|numeric|min:0|max:100',
            'plan_progress_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $profileData = $request->only([
            'membership',
            'body_fats_percentage',
            'muscle_mass_percentage',
            'water_percentage',
            'bone_mass_percentage',
            'other_composition_percentage',
            'cardio_percentage',
            'daily_goal_percentage',
            'calories_percentage',
            'plan_progress_percentage',
        ]);

        $profileData['user_id'] = $user->id;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName);
            $profileData['image'] = $imageName;
        }

        ProfileUser::create($profileData);

        if ($request->filled('username') && $request->filled('fullname')) {
            $user->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
            ]);
        } else {
            return redirect()->back()->withErrors(['username' => 'Username and Fullname are required']);
        }

        if ($user->username) {
            return redirect()->route('profileuser.show', ['username' => $user->username])->with('success', 'Profile created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
    }

    // badges 
   

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profileUser = ProfileUser::with('badges')->where('user_id', $user->id)->firstOrFail();
       

        $bookedSessions = BookedSession::where('create_user_id', $user->id)->get();
    
        return view('website.pages.Profiles.Userprofile.show', compact('user', 'profileUser', 'bookedSessions'));
    }
    

    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profileUser = ProfileUser::where('create_user_id', $user->id)->firstOrFail();

        return view('website.pages.Profiles.Userprofile.edit', compact('user', 'profileUser'));
    }

    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $profileUser = ProfileUser::where('create_user_id', $user->id)->firstOrFail();

        $request->validate([
            'fullname' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'image' => 'nullable|image|max:2048',
            'membership' => 'nullable|string|max:255',
            'body_fats_percentage' => 'nullable|numeric',
            'muscle_mass_percentage' => 'nullable|numeric',
            'water_percentage' => 'nullable|numeric',
            'bone_mass_percentage' => 'nullable|numeric',
            'other_composition_percentage' => 'nullable|numeric',
            'cardio_percentage' => 'nullable|numeric|min:0|max:100',
            'daily_goal_percentage' => 'nullable|numeric|min:0|max:100',
            'calories_percentage' => 'nullable|numeric|min:0|max:100',
            'plan_progress_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $user->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
        ]);

        $profileUser->update([
            'membership' => $request->membership,
            'body_fats_percentage' => $request->body_fats_percentage,
            'muscle_mass_percentage' => $request->muscle_mass_percentage,
            'water_percentage' => $request->water_percentage,
            'bone_mass_percentage' => $request->bone_mass_percentage,
            'other_composition_percentage' => $request->other_composition_percentage,
            'cardio_percentage' => $request->cardio_percentage,
            'daily_goal_percentage' => $request->daily_goal_percentage,
            'calories_percentage' => $request->calories_percentage,
            'plan_progress_percentage' => $request->plan_progress_percentage,
        ]);

        if ($request->hasFile('image')) {
            if ($profileUser->image) {
                $oldImagePath = storage_path('app/public/profiles/' . $profileUser->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName);

            $profileUser->update(['image' => $imageName]);
        }

        if ($user->username) {
            return redirect()->route('profileuser.show', ['username' => $user->username])->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
    }

    
   /*  public function updateProgress(Request $request, $userId)
    {
        $profileUser = UserProfile::where('user_id', $userId)->first();
    
        if ($profileUser) {
            // زيادة عدد الفيديوهات التي تم مشاهدتها
            $profileUser->videos_watched += $request->input('videos_watched');
            $profileUser->cardio_percentage += 25; // كل فيديو يعادل 25%
            $profileUser->save();
    
            // إضافة شارات بناءً على التقدم
            $this->assignBadge($profileUser);
    
            return response()->json([
                'success' => true,
                'message' => 'Progress updated successfully!',
                'progress' => [
                    'cardio' => $profileUser->cardio_percentage,
                    'plan' => $profileUser->plan_progress_percentage,
                ],
                'badges' => $profileUser->badges // جلب الشارات الجديدة
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'User profile not found.'
        ], 404);
    } */
    
    // دالة خاصة لإضافة شارات
  /*   protected function assignBadge($profileUser)
    {
        $badges = [
            25 => ['name' => 'Beginner', 'image' => 'images/badges/beginner.png'],
            50 => ['name' => 'Intermediate', 'image' => 'images/badges/intermediate.png'],
            75 => ['name' => 'Advanced', 'image' => 'images/badges/advanced.png'],
            100 => ['name' => 'Expert', 'image' => 'images/badges/expert.png'],
        ];
    
        if (isset($badges[$profileUser->cardio_percentage])) {
            $badge = $badges[$profileUser->cardio_percentage];
    
            // التحقق من أن الشارة لم تتم إضافتها مسبقًا
            if (!UserBadge::where('user_id', $profileUser->user_id)
                ->where('badge_name', $badge['name'])
                ->exists()) {
                UserBadge::create([
                    'user_id' => $profileUser->user_id,
                    'badge_name' => $badge['name'],
                    'badge_image' => $badge['image'],
                ]);
            }
        }
    } */
    
    
}
