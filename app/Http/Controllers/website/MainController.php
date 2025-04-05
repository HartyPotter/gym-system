<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan; 
use App\Models\User; 
use App\Models\Blog;  

class MainController extends Controller
{
     // Home Page 
     public function home() {
        $plans = Plan::latest()->simplePaginate(5);
        $user = auth()->user();
        $trainers = User::where('user_type', 'trainer')->simplePaginate(5);
        $blogs = Blog::paginate(10);
        
       /*  if ($user->user_type === 'customer') {
           
            $receiver = User::where('user_type', 'trainer')->first(); 
        } elseif ($user->user_type === 'trainer') {
           
            $receiver = User::where('user_type', 'customer')->first();
        } else {
            
            $receiver = null;
        } */
        return view('website.pages.home', compact('plans', 'user', 'trainers', 'blogs'));
    }
    
    public function joinus() {
        
        return view('website.pages.joinus');
    }
   
    public function selectPlan(Request $request, $planId)
{
    // الحصول على المستخدم الحالي
    $user = auth()->user();
    $plan = Plan::find($planId);

    if (!$plan) {
        return redirect()->route('home'); // العودة إلى الصفحة الرئيسية إذا لم توجد الخطة
    }

   
    $user->selected_plan_id = $plan->id;
    $user->save();

    $user->notify(new PlanSelected($plan));
    return redirect()->route('home');
}

}
