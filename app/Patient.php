<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Patient extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'patients';

    protected $appends = [
        'photo',
    ];

    const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const JOB_TYPE_SELECT = [
        'Permanent' => 'Permanent',
        'Contract'  => 'Contract',
        'Intern'    => 'Intern',
        'Volunteer' => 'Volunteer',
    ];

    const BLOOD_GROUP_SELECT = [
        'A+'  => 'A+',
        'A-'  => 'A-',
        'B+'  => 'B+',
        'B-'  => 'B-',
        'O+'  => 'O+',
        'O-'  => 'O-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
    ];

    protected $fillable = [
        'dob',
        'email',
        'phone',
        'gender',
        'office',
        'address',
        'pin_code',
        'job_type',
        'last_name',
        'first_name',
        'department',
        'created_at',
        'updated_at',
        'deleted_at',
        'blood_group',
        'designation',
    ];

    const OFFICE_SELECT = [
        'OTP' => 'Office of the President',
        'OVP' => 'Office of the Vice President',
        'OCM' => 'Office of the Chief Minister',
        'OFL' => 'Office of the First Lady',
        'SL'  => 'State Lodge',
    ];

    public function registerMediaConversions(?Media $media = null): void    
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class);
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
