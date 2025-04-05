<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PayMobController,SubscriptionController};
use App\Http\Controllers\website\{MainController,TrainerController,BookedSessionController,ProfileUserController ,TrainerProfileController , ChatController ,VideoController};
use App\Http\Controllers\dashboard\{DashboardController,UserController , PlanController ,AdminProfileController , BlogController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/joinus', [MainController::class, 'joinus'])->name('joinus');
//booked session 
Route::get('/book-session', [BookedSessionController::class, 'create'])->name('book-session.create');
Route::post('/book-session', [BookedSessionController::class, 'store'])->name('book-session.store');
Route::delete('/book-session/{id}', [BookedSessionController::class, 'destroy'])->name('book-session.destroy');

// profile user
Route::get('/user/profile/create', [ProfileUserController::class, 'create'])->name('profile.create');
Route::post('/user/profile', [ProfileUserController::class, 'store'])->name('profile.store');
Route::get('/profile/{username}', [ProfileUserController::class, 'show'])->name('profileuser.show');
Route::get('/profile/{username}/edit', [ProfileUserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{username}', [ProfileUserController::class, 'update'])->name('profile.update');
/* // Route to update progress after watching a video
Route::post('/user/{userId}/update-progress', [ProfileUserController::class, 'updateProgress'])->name('user.updateProgress');
// Gym Videos under User Profile
Route::get('/user/profile/gym-videos', function () {
    return view('website.pages.Profiles.Userprofile.training');
})->name('profile.gym_videos'); */

Route::get('/video-gym', [VideoController::class, 'index'])->name('video.gym');
Route::post('/video-watched/{video}', [VideoController::class, 'videoWatched'])->name('video.watched');




//profile trainer
Route::get('/create', [TrainerProfileController::class, 'create'])->name('trainerprofile.create');
Route::post('/store', [TrainerProfileController::class, 'store'])->name('trainerprofile.store');
Route::get('/show/{id}', [TrainerProfileController::class, 'show'])->name('trainerprofile.show');
Route::get('/edit/{id}', [TrainerProfileController::class, 'edit'])->name('trainerprofile.edit');
Route::put('/update/{id}', [TrainerProfileController::class, 'update'])->name('trainerprofile.update');

//chat
Route::middleware('auth')
    ->prefix('chat')
    ->name('chat.')
    ->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::post('/send', [ChatController::class, 'send'])->name('send');
    Route::get('/messages', [ChatController::class, 'fetchMessages'])->name('fetchMessages');
    Route::post('/mark-seen', [ChatController::class, 'markAsSeen'])->name('markAsSeen');
    Route::get('/chat/unseen-counts', [ChatController::class, 'fetchUnseenCounts'])->name('unseen-counts');
    Route::patch('/update/{id}', [ChatController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ChatController::class, 'destroy'])->name('destroy');
});

// plan 
Route::post('/select-plan/{planId}', [MainController::class, 'selectPlan'])->name('selectPlan');

// paymob 
Route::get('/checkout', function () {
    return view('Payment.checkout');
})->name('checkout');

Route::post('/checkout', [SubscriptionController::class, 'store'])->name('checkout');
Route::post('/checkout/processed', [PayMobController::class, 'checkoutProcessed'])
    ->name('checkout.processed');

Route::get('/checkout/response', function (Request $request) {
    if ($request->success == false) {

        return view('Payment.pay_failed');
    }
    return view('Payment.pay_success');
})->name('checkout.response');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home_auth');

Route::group([
    'middleware' => ['auth', 'dashboard'],
], function () {
Route::prefix('dashboard')->group(function (){
    //HOME 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //USERS
    Route::resource('/users', UserController::class)->parameters(['users' => 'username']);
    Route::get('/user/customer',[UserController::class, 'customersIndex'])->name('users.customers');
    Route::get('/user/trainer',[UserController::class, 'trainerIndex'])->name('users.trainers');
    Route::get('/user/admin',[UserController::class, 'adminIndex'])->name('users.admins');

    //PLAN
    Route::resource('plans', PlanController::class);
    
    // profile admin 

    Route::get('/admin/{username}', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('/admin/{username}/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/{username}', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    //BLOG 
    Route::resource('blogs', BlogController::class);

});

});