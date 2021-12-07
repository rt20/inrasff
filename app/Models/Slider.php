<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function sliderImage()
    {
        return $this->hasMany(SliderImage::class, 'slider_id', 'id');
    }

    public function getSettings(){
        return $this->settings == null ?
            [] :
            json_decode($this->settings, 1);
    }
}
