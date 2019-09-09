<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function task() {
        return $this->hasMany(Task::class);
    }
}
