<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    public $timestamps = false;

    protected $table = 'Users';

    protected $primaryKey = 'UserID';

    protected $fillable = [
        'UserID',
        'Username',
        'Email',
        'Password',
        'LockedOut',
        'Attempts',
        'Firstname',
        'Lastname',
    ];

    public function isLockedOut()
    {
        return $this->LockedOut == 1;
    }

    public function resetAttempts()
    {
        $this->Attempts = 0;
        $this->save();

        return $this;
    }

    public function incrementAttempts()
    {
        $this->Attempts++;
        $this->save();

        return $this;
    }

    public function lockAccount()
    {
        $this->lockedout = 1;
        $this->attempts = 0;
        $this->save();

        return $this;
    }

    public function unlockAccount()
    {
        $this->lockedout = 0;
        $this->attempts = 0;
        $this->save();

        return $this;
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'UserRoles', 'UserID', 'RoleID');
    }
    
    public function hasRole($role)
    {
        return $this->roles()->where('RoleName', $role)->exists();
    }

}
