@extends('layouts.main')

@section('container')
<div class="container min-vh-100 pt-5">
    <div class="row d-flex flex-row justify-content-center align-items-center min-vh-75">
        <p class="h1 text-center" style="margin-top: 6rem"><strong> CONTACT </strong></p>
        <div class="col-3">
                    <div class="card p-2 rounded-5">
                        <a class="card-block text-decoration-none" href="https://wa.me/6282154531382">
                            <i class="bi bi-whatsapp" style="font-size: 5rem"></i>
                            <h4 class="card-title">Whatsapp</h4>
                            <p class="card-text">0821-5453-1382</p>
                        </a>
                    </div>
        </div>
        <div class="col-3">
                    <div class="card p-2 rounded-5">
                        <a class="card-block text-decoration-none" href>
                            <i class="bi bi-envelope" style="font-size: 5rem"></i>
                            <h4 class="card-title">Email</h4>
                            <p class="card-text">fikri.alichsan@gmail.com</p>
                        </a>
                    </div>
        </div>
        <div class="col-3">
                    <div class="card p-2 rounded-5">
                        <a class="card-block text-decoration-none" href="https://www.instagram.com/fikrichsan/">
                            <i class="bi bi-instagram" style="font-size: 5rem"></i>
                            <h4 class="card-title">Instagram</h4>
                            <p class="card-text">fikrichsan</p>
                        </a>
                    </div>
        </div>
    </div>
</div>
    
@endsection

@php
    $showsidebar = false;
    $showNavbar = true;
@endphp