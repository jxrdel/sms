@extends('layout')

@section('title')
  <title>SMS | Home</title>
@endsection

@section('styles')
    <style>
        .card{
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            padding: 14px 80px 18px 36px;
            cursor: pointer;
        }

        .card:hover{
            transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .card h3{
        font-weight: 600;
        }

        .card img{
        position: absolute;
        top: 20px;
        right: 15px;
        max-height: 120px;
        }

        .card{
            min-height: 150px;
        }

        @media(max-width: 990px){
        .card{
            margin: 20px;
        }
        } 
    </style>
@endsection

@section('content')
    
  <h1 style="text-align: center"><i class="ti ti-file-dollar"></i> &nbsp; <strong>Supplier Management System</strong></h1>
<div class="row" style="margin-top: 60px">
    <div class="col-md-4">
        <a href="{{ route('suppliers') }}">
            <div class="card card-1">
                <h3 style="margin: auto"><i class="fas fa-truck"></i> &nbsp; Suppliers</h3>
                <p style="color: black; margin: auto; width: 120%; margin-top: 10px">Search, Create and Edit suppliers that are employed by the Ministry of Health</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('categories') }}">
            <div class="card card-2">
                <h3 style="margin: auto"><i class="bi bi-journal-text"></i> &nbsp; Categories</h3>
                <p style="color: black; margin: auto; width: 120%; margin-top: 10px">Manage the categories of suppliers employed by the Ministry of Health and their associated suppliers</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        @if (auth()->user()->hasRole('Admin'))
            <a href="{{ route('users') }}">
                <div class="card card-3">
                    <h3 style="margin: auto"><i class="fas fa-users"></i> &nbsp; Users</h3>
                    <p style="color: black; margin: auto; width: 120%; margin-top: 10px">Administrate User Accounts: Manage Access, Assign Roles, and Create users</p>
                </div>
            </a>
        @endif
    </div>
  </div>

@endsection