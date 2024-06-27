<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users');
    }

    public function getUsers()
    {
        $query = User::all();

        return DataTables::of($query)->make(true);
    }
}
