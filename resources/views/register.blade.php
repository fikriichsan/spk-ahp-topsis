@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-7 px-0 d-none d-sm-block rounded-end">
        <img src="img/login.jpg"
          alt="Login image" class="w-100 vh-100 shadow rounded-end-5" style="object-fit: cover; object-position: center;">
      </div>
      <div class="col-sm-5 px-5 d-flex flex-column justify-content-center alignment-items-center bg-body-tertiary">
        <div class="row d-flex justify-content-center px-5 mx-5">
          <h2 class="text-secondary">Welcome</h2>
          <p class="fs-5 text-muted">Register to create your first account</p>
          <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <button class="btn btn-primary mb-4 w-100" type="submit">Register</button>
            <p class="text-center">Already have account? <a href="/login" class="link-info">Log in</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@php
    $showsidebar = false;
@endphp