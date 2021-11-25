<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    
    protected $fillable = [
        'title',
        'image',
    ];

    public function getImage(){
        if($this->image != null){
            return asset('storage/gallery/'.$this->image);
        }
        return null;
    }
}
