@extends('layouts.main')

@section('container')
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12 p-3">
            <div class="card rounded border">
                <div class="card-header">
                    Maps Sekolah
                </div>
                <div class="card-body">
                    <div id="map" class="rounded" style="height: 25rem"></div>
                </div>
            </div>
        </div>
</div>
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-12">
            <div class="table-responsive bg-white border rounded-4">
                <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">NPSN</th>
                            <th scope="col">Akreditasi</th>
                            <th scope="col">Jarak</th>
                            <th scope="col">Nilai Akhir</th>
                            <th scope="col">Ranking</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $item)
                                <tr>
                                    <td class="align-middle" style="table-layout: fixed"><a href="/alternatif/{{ $item['id'] }}">{{ $item['nama_sekolah'] }}</a></td>
                                    <td class="align-middle">{{ $item['npsn'] }}</td>
                                    @if ($item['akreditasi']>=86)
                                        <td class="align-middle">A</td>
                                    @elseif ($item['akreditasi']>=76)
                                        <td class="align-middle">B</td>
                                    @elseif ($item['akreditasi']>=56)
                                        <td class="align-middle">C</td>
                                    @else
                                        <td class="align-middle">-</td>
                                    @endif
                                    <td class="align-middle">{{ $item['jarak'] }} km</td>
                                    <td class="align-middle">{{ $item['score'] }}</td>
                                    <td class="align-middle">{{ $item['rank'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              </div>
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
        var map = L.map('map').setView([-1.269160, 116.825264], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var alternatives = @json($lokasi_sekolah);
        
        Object.keys(alternatives).forEach(function (item, key) {
            var alternative = alternatives[item];
            for (let index = 0; index < alternative.length; index++) {
              var latitude = alternative[index].latitude;
              var longitude = alternative[index].longitude;
              var name = alternative[index].nama_sekolah;
              
              L.marker([latitude, longitude])
                  .bindPopup(name)
                  .addTo(map)
                  .openPopup();  
            }
        })
    })
</script>