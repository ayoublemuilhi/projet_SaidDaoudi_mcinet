<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualite extends Model
{
    use SoftDeletes;
    protected $table = 'qualites';
    protected $guarded = [];
}
