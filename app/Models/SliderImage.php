<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'subtitle',
        'link',
        'slider_id'
    ];

    protected $appends = [
        'ref',
        'ref_thumb'
    ];

    public function getRefAttribute(){
        return $this->image == null ? 
            '#' :
            asset('storage/slider_image/'.$this->image);
    }
    public function getRefThumbAttribute(){
        return $this->image == null ? 
            '#' :
            asset('storage/slider_image/thumb_'.$this->image);
    }
}
