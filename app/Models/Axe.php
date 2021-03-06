<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Axe extends Model
{
    use SoftDeletes;
    protected $table = 'axes';
    protected $guarded = [];

    ############################# Start Relation

    public function rhsd(){
        return $this->hasMany(Rhsd::class,'axe_id','id');
    }



    ############################# End Relation
}
