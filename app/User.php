<?php

namespace App;

use App\Models\Rhsd;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'password','image','status','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    ############################# Start Relation
    public function rhsd(){
        return $this->hasMany(Rhsd::class,'user_id','id');
    }

    public function UserRoles(){
        return $this->belongsToMany(Role::class,'model_has_roles','role_id','model_id','id','id')->select('name');
    }
    ############################# End Relation

}
