<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_log_id', 'start_time', 'end_time', 'image_path'];

    public function attendanceLog()
    {
        return $this->belongsTo(AttendanceLog::class);
    }

}
