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
        'first_name',
        'last_name',    
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'pin_code',     
        'blood_group',
        'pet_name',
        'pet_type',
        'pet_breed',
        'pet_dob',
        'pet_gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const OFFICE_SELECT = [
        'main' => 'Main Office',
        'branch' => 'Branch Office'
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
    
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}