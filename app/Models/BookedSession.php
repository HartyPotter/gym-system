<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookedSession extends Model
{
    use HasFactory;
    protected $guarded =[] ;

    public function create_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'create_user_id', 'id');
    }

    public function update_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'update_user_id', 'id');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class,'trainer_id','id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
