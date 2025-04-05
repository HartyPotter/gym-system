<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileUser;
use App\Models\Badge;
use App\Models\User;
class VideoController extends Controller
{
    public function index()
    {
        $videos = [
            ['id' => 1, 'title' => 'Cardio Workout', 'url' => asset('assets/videos/4761426-uhd_4096_2160_25fps.mp4')],
            ['id' => 2, 'title' => 'Strength Training', 'url' => asset('assets/videos/3195943-uhd_3840_2160_25fps.mp4')],
            ['id' => 3, 'title' => 'Yoga Session', 'url' => asset('assets/videos/18941351-hd_1080_1920_50fps.mp4')],
            ['id' => 4, 'title' => 'HIIT Challenge', 'url' => asset('assets/videos/5320011-uhd_2160_3840_25fps.mp4')],
        ];

        return view('website.pages.Profiles.Userprofile.video_gym', compact('videos'));
    }
   
    public function videoWatched($videoId)
    {
        $userId = auth()->id(); // الحصول على userId من الـ session أو الـ authentication
    
        $profileUser = ProfileUser::where('user_id', $userId)->first();
        
        if ($profileUser) {
            $profileUser->videos_watched += 1;
    
            // حساب النسبة الجديدة لكل Progress Bar
            $newProgress = min($profileUser->videos_watched * 25, 100);
            $profileUser->cardio_percentage = $newProgress;
            $profileUser->daily_goal_percentage = $newProgress;
            $profileUser->calories_percentage = $newProgress;
            $profileUser->plan_progress_percentage = $newProgress;
            $profileUser->save();
    
            // إضافة الـ Badges بناءً على التقدم
            $this->assignBadge($profileUser, $newProgress);
        } else {
            // التعامل مع الحالة عندما لا يتم العثور على المستخدم
            return redirect()->route('profileuser.show', ['username' => auth()->user()->username])->with('error', 'Profile not found.');
        }
    
        return redirect()->route('profileuser.show', ['username' => auth()->user()->username]);
    }
    

    private function assignBadge($profileUser, $progress)
    {
        $badges = [
            25 => ['name' => 'Beginner', 'image' => asset('assets/images/user_profile/Beginner.png')],
            50 => ['name' => 'Intermediate', 'image' => asset('assets/images/user_profile/Intermediate.png')],
            75 => ['name' => 'Advanced', 'image' => asset('assets/images/user_profile/Advanced.png')],
            100 => ['name' => 'Expert', 'image' => asset('assets/images/user_profile/Expert.png')],
        ];
    
        if (isset($badges[$progress])) {
            $badge = Badge::firstOrCreate(
                ['name' => $badges[$progress]['name']],
                ['image' => $badges[$progress]['image'], 'progress_threshold' => $progress]
            );
    
            // إضافة الشارة للمستخدم
            $profileUser->badges()->create([
                'name' => $badge->name,
                'image' => $badge->image,
                'progress_threshold' => $badge->progress_threshold,
            ]);
        }
    }
    
}
