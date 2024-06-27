<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'SubCategory';

    protected $primaryKey = 'SubCategoryID';

    protected $fillable = [
        'SubCategoryID',
        'SubCategoryName',
    ];

    public static function nameExists($name)
    {
        return self::where('SubCategoryName', $name)->exists();
    }
}
