<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rhsd extends Model
{
    use SoftDeletes;
    protected $table = 'rhsd';
    protected $guarded = [];



    ############################# Start Relation

    public function qualite(){
        return $this->belongsTo(Qualite::class,'qualite_id','id');
    }

    public function dpci(){
        return $this->belongsTo(DP::class,'domaine_id','id');
    }

    public function axe(){
        return $this->belongsTo(Axe::class,'axe_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    ############################# End Relation
}
