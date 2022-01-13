<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
    ];
}
