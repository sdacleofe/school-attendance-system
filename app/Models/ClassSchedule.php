<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class ClassSchedule extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'class_schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['class_id', 'subject_id', 'date', 'start_time', 'end_time', 'teacher_id'];

    /**
     * Get the class that owns the class schedule.
     */

    public function class() {
        return $this->belongsTo('App\Models\Classes', 'class_id');
    }
}
