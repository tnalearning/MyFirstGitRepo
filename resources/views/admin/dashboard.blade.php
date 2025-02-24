@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin {{ auth()->user()->name }}!</p>
    </div>
@endsection
