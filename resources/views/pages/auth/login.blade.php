@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Login</h4>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method='post' action='{{ route('login.store') }}'>
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email address"
                                    name='email' required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter your password"
                                    name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary my-3">Login</button>
                        </form>
                        <p>
                            Don’t have an account, <a href="{{ url('signup') }}">Register Now </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
