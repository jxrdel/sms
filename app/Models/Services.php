<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $table = 'Services';

    protected $primaryKey = 'ServiceID';

    protected $fillable = [
        'ServiceID',
        'ServiceName',
    ];
}
