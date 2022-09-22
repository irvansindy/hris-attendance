<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class HrisAttendance extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "hris_attendances";
    // protected $table = "hrdattendancetemp";
    protected $guarded = [];
}
