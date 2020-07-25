<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{
    protected $fillable = [
        'hospital_name', 'hospital_url'
    ];
    protected $appends = ['photo_full_path'];
    public function getPhotoFullPathAttribute()
	{
		return isset($this->attributes['photo']) ?  '/images/' . $this->attributes['photo'] : null;
    }
    
}
