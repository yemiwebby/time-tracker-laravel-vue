<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @var array
     *
     */
    protected $fillable = ['name', 'user_id'];

    protected $with = ['user'];

    /**
     * Get associated user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class );
    }

    /**
     * Get associated timers.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

    /**
     * Get my projects
     * @param $query
     * @return mixed
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }
}
