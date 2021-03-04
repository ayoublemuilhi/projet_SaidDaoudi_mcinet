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
    ############################### End Relation
}
