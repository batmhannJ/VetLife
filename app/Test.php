<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'tests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const RDT_SELECT = [
        'Negative' => 'Negative',
        'Positive' => 'Positive',
    ];

    protected $fillable = [
        'rdt',
        'heart_rate',
        'created_at',
        'updated_at',
        'deleted_at',
        'blood_pressure',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}
