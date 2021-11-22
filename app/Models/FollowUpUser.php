<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fun_id'
    ];

    /**
     * Get the user that owns the FollowUpUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the followUp that owns the FollowUpUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function followUp()
    {
        return $this->belongsTo(FollowUpNotification::class, 'fu_id');
    }
}
