@extends('layout')

@section('title')
  <title>SMS | Users</title>
@endsection
@section('content')
    
    <h2 style="text-align: center"><i style="color: #5D87FF" class="bi bi-question-circle-fill"></i> &nbsp; User Manual</h2>
    <br>
    <iframe src="{{ asset('assets/manual.pdf') }}" width="100%" height="1000px"></iframe>
        
          

@endsection