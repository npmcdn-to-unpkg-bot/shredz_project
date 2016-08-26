<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FitnessGoal extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'customer_fitness_goal', 'fitness_goal_id', 'customer_id')->withTimestamps();
    }

    /**
     * Retrieve Fitness goal by name
     */
    public static function byName($name)
    {
    	return static::where('name', $name)->first();
    }
}
