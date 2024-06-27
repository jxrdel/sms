<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services');
    }

    public function getServices()
    {
        $query = Services::all();

        return DataTables::of($query)->make(true);
    }
}
