<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTimeRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday_id',
        'start_time',
        'end_time',
        'is_active', //	0:Inactive 1:Active
    ];

    public function weekDay()
    {
        return $this->belongsTo(Weekday::class, 'id');
    }

    public function getWeekdayNameAttribute()
    {
        return $this->weekDay?->name;
    }
}
