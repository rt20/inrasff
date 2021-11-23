<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kementrian extends Model
{
    use HasFactory;

    protected $table = 'kementrian';
    
    protected $fillable = [
        'title',
        'content',
        'image',
        'link',
        'facebook',
        'twitter',
        'instagram',
    ];

    public function getImage(){
        if($this->image != null){
            return asset('storage/kementrian/'.$this->image);
        }
        return null;
    }
}
