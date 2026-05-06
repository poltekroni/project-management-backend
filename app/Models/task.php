<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'ststus',
        'due_date'
    ];

    public function project(){
        return $this->belongsTo(project::class);
    }
}
