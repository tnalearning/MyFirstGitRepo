@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Super Admin Dashboard</h1>
        <p>Welcome, Super Admin {{ auth()->user()->name }}!</p>
    </div>
@endsection
