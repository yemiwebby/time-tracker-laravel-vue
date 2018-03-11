<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'name', 'user_id', 'project_id', 'stopped_at', 'started_at'
    ];

    protected $dates = ['started_at','stopped_at'];


    protected $with = ['user'];

    /**
     * Get the related user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related project
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the timer for the current user
     * @param $query
     * @return mixed
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }

    /**
     * Get the running timers
     * @param $query
     * @return mixed
     */
    public function scopeRunning($query)
    {
        return $query->whereNull('stopped_at');
    }
}
