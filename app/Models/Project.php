<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'start_date', 'deadline'];
    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
    ];
    //----------
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //----------
    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
