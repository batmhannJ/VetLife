<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'prescriptions';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'date_issued',
    ];

    protected $fillable = [
        'drug_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'date_issued',
        'quantity_issued',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }

    public function drug()
    {
        return $this->belongsTo(Medicine::class, 'drug_id');
    }

    public function getDateIssuedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateIssuedAttribute($value)
    {
        $this->attributes['date_issued'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
