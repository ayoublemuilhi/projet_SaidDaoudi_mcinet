<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DP extends Model
{
    use SoftDeletes;
    protected $table = 'dpci';
    protected $guarded = [];

    ############################## Start Relation
    public function region(){
        return $this->belongsTo(DR::class,'dr_id','id');
    }

    public function rhsd(){
        return $this->hasMany(Rhsd::class,'domaine_id','id');
    }


    ############################### End Relation


    ################## Accessors #####################

    public function getTypeAttribute($val){
       return  $val == "P" ? 'Province' : 'Region';
    }

}
