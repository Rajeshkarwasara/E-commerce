<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;  // Import this trait
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;  // Use the trait here

    const ADMIN_ROLE = 1;
    const USER_ROLE = 0;
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'address',
        'contact',
        'gender',
        'country',
        'profile',
        'role_id',
    ];
}
