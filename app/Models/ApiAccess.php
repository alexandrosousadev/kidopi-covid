<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiAccess extends Model
{
    protected $fillable = ['country', 'accessed_at'];
}