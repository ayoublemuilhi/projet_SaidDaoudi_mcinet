<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Indicateur extends Model
{
    protected $table = 'indicateurs';
    use SoftDeletes;
    protected $guarded = [];
}
