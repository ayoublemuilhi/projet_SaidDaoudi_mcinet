<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DR extends Model
{
    use SoftDeletes;
    protected $table = 'dr';
   protected $guarded = [];

}
