@extends('layouts.admin')

@section('content')
    <form action="{{dashboard_route('admin.login.process')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Phone or Email*</label>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" placeholder="phone or mail@domain.com">
                <label for="login">phone or mail@domain.com</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password*</label>
            <div class="form-floating position-relative mb-3" x-data="{ showPassword: false }">
                <input :type="showPassword ? 'text' : 'password'" class="form-control" id="password" name="password" placeholder="name@example.com" style="padding-right: calc(3.5rem + 2px);">
                <label for="password">Min. 8 characters</label>
                <button type="button" class="btn btn-eye" @click="showPassword = !showPassword"
                        :aria-label="showPassword ? 'Hide password' : 'Show password'"
                        :aria-pressed="showPassword.toString()">
                    <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'" aria-hidden="true"></i>
                </button>
            </div>
        </div>  
        <div class="d-flex justify-content-between">
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="keep_logged_in" name="keep_logged_in">
                <label class="form-check-label" for="keep_logged_in">Keep me logged in</label>
            </div>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit" class="btn">Sign In</button>
    </form>
    @error('login')
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @error('password')
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
@endsection