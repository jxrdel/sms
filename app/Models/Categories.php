<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $table = 'Category';

    protected $primaryKey = 'CategoryID';

    protected $fillable = [
        'CategoryID',
        'CategoryName',
    ];

    public static function nameExists($name)
    {
        return self::where('CategoryName', $name)->exists();
    }
}
