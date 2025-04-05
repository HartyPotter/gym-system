<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class ProfileUser extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function create_user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'create_user_id', 'id');
    }

    public function update_user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'update_user_id', 'id');
    }

    public function badges(): HasMany
    {
        return $this->hasMany(Badge::class, 'profileUser_id'); // حيث 'profileUser_id' هو المفتاح الأجنبي في جدول badges
    }
   
    

}
