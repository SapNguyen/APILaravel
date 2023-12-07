<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    public $timestamps = false;
    public $primaryKey = "idshow";

    use HasFactory;
}
