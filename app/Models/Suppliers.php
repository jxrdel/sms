<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $table = 'Suppliers';

    protected $primaryKey = 'SupplierID';

    protected $fillable = [
        'SupplierID',
        'SupplierName',
        'Address',
        'PhoneNo',
        'IsActive',
        'Email',
        'PrimaryContactName',
        'PrimaryContactNo',
        'PrimaryContactEmail',
        'SecondaryContactName',
        'SecondaryContactNo',
        'SecondaryContactEmail',
        'Notes',
        'MainCategoryID',
        'SubCategoryID',
        'IsIndividual',
        'IDNumber',
        'Range',
    ];
}
