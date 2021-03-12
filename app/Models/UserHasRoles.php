<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasRoles extends Model
{
    protected $table = "model_has_roles";
    ## model_id ====> user_id
    protected $fillable = ['role_id','model_type','model_id'];
}
