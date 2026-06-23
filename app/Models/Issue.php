<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Issue extends Model
{
    protected $fillable = ['project_id', 'title', 'description', 'status', 'priority', 'due_date'];
    protected $casts = [
        'due_date' => 'date',
    ];
    //----------
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    //----------
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    //----------
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    //----------
    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'issue_user');
    }
}
