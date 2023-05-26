<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserParts extends Model
{
    use HasFactory;

    protected $table = 'users_parts';
    protected $fillable = ['user_id', 'part_id'];
}
