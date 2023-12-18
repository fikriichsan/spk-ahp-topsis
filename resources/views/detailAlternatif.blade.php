@extends('layouts.main')

@section('container')
<div class="container min-vh-100 pt-5">
    <col class="row d-flex flex-row justify-content-center align-items-center min-vh-75">
        <p class="h1 text-center" style="margin-top: 6rem; margin-bottom: 6rem"><strong> {{ $alternative->nama_sekolah }}</strong></p>
        <div class="col-12 my-5">
            <div class="card-body">
                <div id="map" class="rounded" style="height: 25rem"></div>
            </div>
        </div>
        <div class="bg-light-subtle justify-content-center">
            <section class="row pb-3">
                <div class="col-6">
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>NPSN</h6>
                        </div>
                        <div class="col-8">
                            <p class="text-start">{{ $alternative->npsn }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Nama Sekolah</h6>
                        </div>
                        <div class="col-8">
                            <p>{{ $alternative->nama_sekolah}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Akreditasi</h6>
                        </div>
                        <div class="col-8">
                            @if ($alternative->akreditasi>=86)
                                <p>A</p>
                            @elseif ($alternative->akreditasi>=76)
                                <p>B</p>
                            @elseif ($alternative->akreditasi>=56)
                                <p>C</p>
                            @else
                                <p>-</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Fasilitas</h6>
                        </div>
                        <div class="col-8">
                            <ul class="">
                                <li>Ruang Kelas: {{ $alternative->ruang_kelas}}</li>
                                <li>Laboratorium: {{ $alternative->laboratorium}}</li>
                                <li>Perpustakaan: {{ $alternative->perpustakaan}}</li>
                                <li>UKS: {{ $alternative->uks}}</li>
                                <li>Sanitasi: {{ $alternative->sanitasi}}</li>
                                <li>Tempat Ibadah: {{ $alternative->tempat_ibadah}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Alamat</h6>
                        </div>
                        <div class="col-8">
                            <span>{{ $alternative->alamat }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Extrakulikuler: </h6>
                        </div>
                        <div class="col-8">
                            <p class="text-start">{{ $alternative->ekstrakulikuler }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Biaya Masuk</h6>
                        </div>
                        <div class="col-8">
                            <p>{{ $alternative->biaya_masuk}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Biaya SPP</h6>
                        </div>
                        <div class="col-8">
                            <p>{{ $alternative->biaya_spp}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Latitude</h6>
                        </div>
                        <div class="col-8">
                            <p>{{ $alternative->latitude}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Longitude</h6>
                        </div>
                        <div class="col-8">
                            <p>{{ $alternative->longitude }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <h6>Narahubung</h6>
                        </div>
                        <div class="col-8">
                            <a href="https://wa.me/{{ $alternative->contact }}" target="_blank">
                                <button class="btn" style="border: 1px solid #43434340">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>{{ $alternative->contact }}</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <hr />
        </div>
    </div>
</div>

@endsection

@php
    $showsidebar = false;
    $showNavbar = true;
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var alternatives = @json($alternative);
        var map = L.map('map').setView([alternatives.latitude, alternatives.longitude], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        Object.keys(alternatives).forEach(function (key) {
        var alternative = alternatives[key];
        var latitude = alternatives.latitude;
        var longitude = alternatives.longitude;
        L.marker([latitude, longitude])
            .bindPopup(alternatives.nama_sekolah)
            .addTo(map)
            .openPopup();
        })
    })
</script>