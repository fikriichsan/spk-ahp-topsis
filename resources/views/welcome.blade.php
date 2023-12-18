@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row d-flex flex-row justify-content-center align-items-center min-vh-100">
            <div class="col-6">
                <p class="h1 "><strong>
                    Bingung Mencari <br />
                    sekolah buat anak anda?
                </strong></p>
                <p class="h5 mb-4 text-secondary">Pada website ini kami akan <mark>membantu</mark> anda <br />
                    untuk memilih sekolah menengah pertama untuk anak anda
                </p>
                <div>
                    <a class="btn btn-primary text-decoration-none" href="/cari-rekomendasi">Get Started</a>
                </div>
            </div>
            <div class="col-6">
                <img src="img/home_image.png" alt="Image Home" height="700">
            </div>
        </div>
    </div>
@endsection

@php
    $showsidebar = false;
    $showNavbar = true;
@endphp