<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'start_at',
        'end_at',
        'client_email',
        'status', // 0:Scheduled 1:Completed 2:Cancelled 3:Admin Cancelled
    ];
}
