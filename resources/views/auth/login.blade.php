@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-5 col-lg-4">
        <div class="glass-card p-4 p-md-5">
            <h2 class="text-center mb-4 fw-bold">Portal Login</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label text-white-50">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="name@sauna.com">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label text-white-50">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-sauna btn-lg">Sign In</button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <small class="text-white-50">Restricted Access System</small>
            </div>
        </div>
    </div>
</div>
@endsection
