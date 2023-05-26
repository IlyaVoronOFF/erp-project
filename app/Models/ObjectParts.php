<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectParts extends Model
{
    use HasFactory;

    protected $table = 'object_parts';
    protected $fillable = ['id', 'object_id', 'part_id', 'user_id', 'daterange', 'time', 'fot_part', 'description'];

    public function part()
    {
        return $this->hasOne(Part::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
