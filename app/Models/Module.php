<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The users that belong to the module.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_modules')
            ->withPivot('active');
            // ->withPivotValue('active', false);
    }
}
