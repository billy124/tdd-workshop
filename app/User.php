<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password',
        'address_line1', 'address_line2', 'city', 'postcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Set the user's password with encryption.
     *
     * @param  string  $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = self::encodePassword($value);
    }
    
    /**
     * 
     * @param type $password
     * @return type
     */
    static public function encodePassword($password) {
        return \Hash::make($password);
    }
}
