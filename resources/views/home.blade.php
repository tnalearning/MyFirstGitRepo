@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                    @if (auth()->user()->hasRole('Admin'))
                        <p>Welcome Admin</p>
                    @elseif (auth()->user()->hasRole('Super Admin'))
                        <p>Welcome Super Admin</p>
                    @elseif (auth()->user()->hasRole('Agent'))
                        <p>Welcome Agent</p>
                    @else
                        <p>Welcome User</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
