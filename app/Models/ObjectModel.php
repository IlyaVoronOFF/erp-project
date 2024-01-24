<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ObjectModel extends Model
{
    protected $table = 'objects';
    protected $fillable = ['id', 'title', 'code', 'daterange', 'user_id', 'stage_id', 'project_sum', 'plan_fot', 'address', 'description', 'archive'];

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

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
