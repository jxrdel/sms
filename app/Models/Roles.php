<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $table = 'Roles';

    protected $primaryKey = 'RoleID';

    protected $fillable = [
        'RoleID',
        'RoleName',
    ];
}
