<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;

class News extends Model
{
    use HasFactory, HasStatus;
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

    protected $appends = [ 'status_label', 'status_class'];
    
    private $states = [
        'draft' => [ 'label' => 'Draft', 'class' => 'info' ],
        'published' => [ 'label' => 'Published', 'class' => 'success' ],
        'rejected' => [ 'label' => 'Rejected', 'class' => 'danger' ],
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function getImage(){
        if($this->image != null){
            return asset('storage/news/'.$this->image);
        }
        return null;
    }
}
