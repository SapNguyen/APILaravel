<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model
{
    public $timestamps = false;
    public $primaryKey = "id_status";

    use HasFactory;
}
