<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unite extends Model
{
    protected $table = 'unites';
    use SoftDeletes;
    protected $guarded = [];
}
