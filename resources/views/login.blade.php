@extends('layouts.main')

@section('container')
  <div class="container-fluid">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: absolute;  right: 1em; top:1em">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session()->has('loginError'))
      <div class="toast alert alert-danger alert-dismissible fade show" aria-live="assertive" aria-atomic="true" role="alert" style="position: absolute;  right: 1em; top:1em">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row">
      <div class="col-sm-7 px-0 d-none d-sm-block rounded-end">
        <img src="img/login.jpg"
          alt="Login image" class="w-100 vh-100 shadow rounded-end-5" style="object-fit: cover; object-position: center;">
      </div>
      <div class="col-sm-5 px-5 d-flex flex-column justify-content-center alignment-items-center bg-body-tertiary">
        <div class="row d-flex justify-content-center px-5 mx-5">
          <h2 class="text-secondary">Welcome Back</h2>
          <p class="fs-5 text-muted">Enter Your Email and Password to Login</p>
          <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukan Email" autofocus required value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
            </div>
            <p class="small mb-4 text-end"><a class="text-muted" href="#!" style="text-decoration: none">Forgot password?</a></p>
            <button class="btn btn-primary mb-4 w-100" type="submit">Login</button>
            <p class="text-center">Don't have an account? <a href="/register" class="link-info">Register here</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@php
    $showsidebar = false;
    $showNavbar = false;
@endphp