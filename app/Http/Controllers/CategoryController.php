<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories');
    }

    public function getCategories()
    {
        $query = Categories::all();

        return DataTables::of($query)->make(true);
    }

    public function getSubcategories()
    {
        $query = Subcategories::all();

        return DataTables::of($query)->make(true);
    }
}
