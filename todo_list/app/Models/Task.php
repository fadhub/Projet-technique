<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
   

    protected $fillable = [
        'title',
        'description',
        'image',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    /**
     * The categories that belong to the task.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
