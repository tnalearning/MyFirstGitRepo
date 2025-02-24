@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the User & Agent Dashboard</h1>
        <p>You are logged in as a {{ auth()->user()->roles->first()->name }}</p>
    </div>
@endsection
