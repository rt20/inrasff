<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    
    private $types = [
        'ccp' => [
            'label' => 'Competent Contact Point'
        ],
        'lccp' => [
            'label' => 'Local Competent Contact Point'
        ]
    ];
    protected $fillable = [
        'name',
        'parent_id',
        'type'
    ];
    
    protected $appends = [
        'type_label'
    ];

    public function getTypeLabelAttribute(){
        if($this->type==null)
            return ;
        
        return $this->types[$this->type]['label'];
    }

    
    public function users()
    {
        return $this->hasMany(User::class, 'institution_id', 'id');
    }

}
