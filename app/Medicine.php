<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'medicines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expiry_date',
        'date_received',
    ];

    const TYPE_SELECT = [
        'Tablet' => 'Tablet',
        'Syrup'  => 'Syrup',
        'IV'     => 'IV',
        'IM'     => 'IM',
    ];

    protected $fillable = [
        'uos',
        'name',
        'type',
        'item_code',
        'created_at',
        'updated_at',
        'deleted_at',
        'expiry_date',
        'generic_name',
        'qty_received',
        'received_from',
        'date_received',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'drug_id', 'id');
    }

    public function getDateReceivedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateReceivedAttribute($value)
    {
        $this->attributes['date_received'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
