<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUser extends Model
{
    protected $fillable = ['email', 'topic', 'description'];
}
