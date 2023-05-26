<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartUser extends Model
{
    protected $table = 'part_user';
    protected $fillable = ['id', 'object_parts_id', 'object_parts_object_id', 'date', 'time', 'description'];
}