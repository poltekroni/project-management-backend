<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    //

    protected $fillable = [
        'name',
        'description',
        'due_date'
    ];

    public function tasks(){
        return $this->hasmany(task::class);
    }
}
