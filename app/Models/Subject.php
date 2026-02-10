<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
