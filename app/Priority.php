<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    public function task()
    {
        return $this->hasOne('App\Task');
    }
}
