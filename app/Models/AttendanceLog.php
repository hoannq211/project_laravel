<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceLog extends Model
{
    use HasFactory,SoftDeletes;

     protected $fillable = ['user_id', 'date'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
    public function getTotalHoursAttribute () {
        return $this->timeEntries->sum(function ($timeEntry) {
            return $timeEntry->end_time - $timeEntry->start_time;
        });
    }
}
