<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::latest()->simplePaginate(5);
        return view('dashboard.pages.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'membership' => 'required|in:Silver,Gold,Platinum',
            'plan' => 'required|in:Basic,Premium,Elite',
            'price' => 'required|numeric|max:99999.99',
            'duration' => 'required|in:day,month,year',
            'features' => 'nullable|string', // تعديل: تحويل features إلى نص
            'create_user_id' => 'nullable|exists:users,id',
            'update_user_id' => 'nullable|exists:users,id',
            'booked_session_id' => 'nullable|exists:booked_sessions,id',
        ]);

        $plan = new Plan();
        $plan->membership = $request->membership;
        $plan->plan = $request->plan;
        $plan->price = $request->price;
        $plan->duration = $request->duration;
        $plan->features = $request->features; // تخزين features كنص مباشر
        $plan->create_user_id = auth()->user()->id;
        $plan->update_user_id = null; // سيتم تحديثه لاحقًا
        $plan->booked_session_id = $request->booked_session_id;

        $plan->save();

        return redirect()->route('plans.index')->with('Created_Plan_Successfully', "The Plan ($plan->name) has been created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return view('dashboard.pages.plan.show', compact('plan'));
    }

    /**
     * edit the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plan = Plan::find($id);
        if (!$plan) {
            return view('dashboard.pages.plan.404');
        }

        return view('dashboard.pages.plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'membership' => 'required|in:Silver,Gold,Platinum',
            'plan' => 'required|in:Basic,Premium,Elite',
            'price' => 'required|numeric|max:99999.99',
            'duration' => 'required|in:day,month,year',
            'features' => 'nullable|string', // تعديل: تحويل features إلى نص
            'create_user_id' => 'nullable|exists:users,id',
            'update_user_id' => 'nullable|exists:users,id',
            'booked_session_id' => 'nullable|exists:booked_sessions,id',
        ]);

        $plan = Plan::find($id);
        if (!$plan) {
            return redirect()->route('plans.index')->with('error', 'Plan not found');
        }

        $plan->membership = $request->membership;
        $plan->plan = $request->plan;
        $plan->price = $request->price;
        $plan->duration = $request->duration;
        $plan->features = $request->features; // تخزين features كنص مباشر
        $plan->update_user_id = auth()->user()->id;
        $plan->booked_session_id = $request->booked_session_id;

        $plan->save();

        return redirect()->route('plans.index')->with('Updated_Plan_Successfully', "The Plan ($plan->name) has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plan = Plan::find($id);
        if (!$plan) {
            return redirect()->route('plans.index')->with('error', 'Plan not found');
        }

        $plan->delete();
        return redirect()->route('plans.index')->with('Deleted_Plan_Sucessfully', "The Plan ($plan->name) has been deleted successfully");
    }
}

