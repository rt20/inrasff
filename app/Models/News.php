<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'show',
        'published_at',
        'status',
        'excerpt',
        'category_id'
    ];

    public function getImage(){
        if($this->image != null){
            return asset('storage/news/'.$this->image);
        }
        return null;
    }
}
