<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    const TYPES = [
        'superadmin' => 'Super Admin',
        'ncp' => 'National Contact Point',
        'ccp' => 'Competent Contact Point',
        'lccp' => 'Local Competent Contact Point',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'fullname',
        'type',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [ 'role_name_label', 'status_label', 'status_class' ];

    /**
     * Get user status class
     */
    public function getStatusClassAttribute()
    {
        return $this->is_active ? 'success' : 'secondary';
    }

    /**
     * Get user status label
     */
    public function getStatusLabelAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Non-Aktif';
    }

    /**
     * Get user role name label
     */
    public function getRoleNameLabelAttribute()
    {
        return $this->type ? self::TYPES[$this->type] : null;
    }

     /**
     * Get list of types can be created
     */
    public static function getCreateableUserTypes()
    {
        // if (!Gate::allows('create all user')) {
            // return ['non-admin' => 'Non Admin'];
        // } else {
            return [
                'ncp' => 'National Contact Point',
                'ccp' => 'Competent Contact Point',
                'lccp' => 'Local Competent Contact Point',
            ];
        // }

    }
}
