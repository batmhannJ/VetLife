<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Patient; // Import the Patient class with its correct namespace
use App\Models\Doctor; // Assuming Doctor is in the Models folder

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'contact',
        'gender',
        'dob',
        'address',
        'ailment',
        'appointment_date',
        'appointment_time',
        'status',
        'doctor_id',
        'notes'
    ];

    /**
     * Get the user that owns the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor for this appointment.
     */
   // In App\Models\Appointment.php

   public function patient()
   {
       return $this->belongsTo(\App\Patient::class);
       return $this->belongsTo(Patient::class, 'user_id');

   }

   public function doctor()
   {
       return $this->belongsTo(Doctor::class);
   }
}