<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function trainer()
    {
            return $this->hasOne(Trainer::class, 'create_user_id', 'id');
    }

    public function bookedSessions()
    {
        return $this->hasMany(BookedSession::class);
    }

    public function profile()
    {
        return $this->hasOne(ProfileUser::class, 'user_id');

    }
    public function users(){
        
        return $this->HasMany(User::class);
    }
    public function create_user()
    {
        return $this->belongsTo(User::class ,'create_user_id','id');
    }
    public function update_user()
    {
        return $this->belongsTo(User::class ,'update_user_id','id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
