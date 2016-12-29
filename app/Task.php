<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
