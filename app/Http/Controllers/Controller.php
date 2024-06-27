<?php

namespace App\Http\Controllers;

class Controller
{
    public function index()
    {
        return view('suppliers-search');
    }

    public function manual()
    {
        return view('manual');
    }
}
