<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpInstitution extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'fun_id'
    ];

    public function followUp()
    {
        return $this->belongsTo(FollowUpNotification::class, 'fu_id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
