<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Doctor extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = [
        'name',
        'email',
        'designation',
        'degree',
        'department',
        'specialist',
        'experience',
        'service_place',
        'birth_date',
        'phone',
        'address',
    ];
    
    protected $casts = [
        'birth_date' => 'date',
        'experience' => 'integer',
    ];
    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
    }

    public function getPhotoAttribute()
    {
        $media = $this->getFirstMedia('photos');
        
        if ($media) {
            return [
                'url' => $media->getUrl(),
                'thumbnail' => $media->getUrl('thumb'),
                'file_name' => $media->file_name,
            ];
        }
        
        return null;
    }
}