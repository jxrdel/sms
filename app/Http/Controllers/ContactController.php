<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function getContacts()
    {
        $query = Contacts::all();

        return DataTables::of($query)->make(true);
    }
}
