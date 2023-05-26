<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $table = 'users';
    protected $fillable = ['id', 'fio', 'email', 'phone', 'password', 'num_pass', 'rule_id', 'special_id', 'oklad'];

    public function parts()
    {
        return $this->hasOne(UserParts::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class, 'rule_id');
    }
}
