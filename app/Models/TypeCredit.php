<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCredit extends Model
{
    use SoftDeletes;
    protected $table = 'type_credits';
    protected $guarded = [];

}
