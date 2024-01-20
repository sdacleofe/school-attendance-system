<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Classes extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'teacher_id',
    ];

    /**
     * Get the teacher that owns the class.
     */
    public function teacher()
    {
        return $this->belongsTo('App\User', 'teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'class_id');
    }
}