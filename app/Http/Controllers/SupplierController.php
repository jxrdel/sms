<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers');
    }
    public function search()
    {
        return view('suppliers-search');
    }

    public function getSuppliers()
    {

        $query = Suppliers::all();

        return DataTables::of($query)->make(true);
    }

    public function getActiveSuppliers()
    {

        $query = Suppliers::where('IsActive' , 1)->get();

        return DataTables::of($query)->make(true);
    }

    public function getInactiveSuppliers()
    {

        $query = Suppliers::where('IsActive' , 0)->get();

        return DataTables::of($query)->make(true);
    }

    public function getIndividuals()
    {

        $query = Suppliers::where('IsIndividual' , 1)->get();

        return DataTables::of($query)->make(true);
    }
}
