@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('admin.home') }}">
                <img src="{{ asset('images/clsu-logo.png') }}" alt="CLSU Logo" style="max-width: 150px; margin-bottom: 20px;">
                <img src="{{ asset('images/logo.png') }}" alt="CLSU-VETLIFE Logo" style="max-width: 250px;">
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Register New Account
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('signup.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autocomplete="name" autofocus placeholder="Full Name" name="name" value="{{ old('name', null) }}">

                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" placeholder="Email Address" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="terms" id="terms" required>
                            <label for="terms">I agree to the terms</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Register
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1 mt-3">
                <a href="{{ route('login') }}" class="text-center">
                    Already have an account? Login
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection