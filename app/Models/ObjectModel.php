<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectModel extends Model
{
    protected $table = 'objects';
    protected $fillable = ['id', 'title', 'code', 'daterange', 'user_id', 'stage_id', 'project_sum', 'plan_fot', 'address', 'description'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function stage()
    {
        return $this->hasOne(Stage::class);
    }

    public function objectParts()
    {
        return $this->hasOne(ObjectParts::class);
    }
}
