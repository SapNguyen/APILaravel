<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;
    public $primaryKey = "idkm";
    use HasFactory;
}
