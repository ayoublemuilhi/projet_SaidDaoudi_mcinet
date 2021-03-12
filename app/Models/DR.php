<?php

namespace App\Models;

use App\Scopes\DPCIScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DR extends Model
{
    use SoftDeletes;
    protected $table = 'dr';
   protected $guarded = [];









}
