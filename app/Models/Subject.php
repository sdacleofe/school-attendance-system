<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Subject extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'class_id', 'name',
    ];

    /**
     * Get the class that owns the subject.
     */

    public function classes() {
        return $this->belongsTo('App\Models\Classes', 'class_id');
    }

    public function class()
{
    return $this->belongsTo('App\Models\Class', 'class_id');
}
}