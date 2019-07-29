<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $guarded = 'id_roles';
}
