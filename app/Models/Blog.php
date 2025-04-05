<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $guarded =[] ;

    protected $casts = [
        'publish_date' => 'datetime',
    ];

    public function create_user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'create_user_id');
    }

    public function update_user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'update_user_id');
    }

}
