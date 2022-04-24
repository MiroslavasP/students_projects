<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    public function getStudents()
    {
        return $this->belongsTo(Students::class, 'group_id', 'group_id');
    }
}
