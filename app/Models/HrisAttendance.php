<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrisAttendance extends Model
{
    use HasFactory;
    protected $table="hris_attendances";
    protected $guarded =[];
}
