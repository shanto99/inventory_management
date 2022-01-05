<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "UserManager";

    protected $primaryKey = "UserID";
    public $incrementing = false;

    protected $fillable = ['UserID', 'UserName', 'Designation', 'Email', 'Password', 'CreatedBy'];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    public function getPhotoUrlAttribute()
    {
        return url('media-example/no-image.png');
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
