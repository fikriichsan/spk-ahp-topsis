@extends('layouts.main')

@section('container')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div>
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-blue order-card shadow">
                    <div class="card-block">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-b-20">Total Pengguna</h6>
                                <h3 class="f-left text-right">{{ $total_user }}</h3>
                            </div>
                            <div class="col my-auto">
                                <i class="fa fa-user f-right text-white-50" style="font-size: 3rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3 ">
                <div class="card bg-c-green order-card shadow">
                    <div class="card-block">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-b-20">Total Sekolah</h6>
                                <h3 class="f-left text-right">{{ $total_alternatif }}</h3>
                            </div>
                            <div class="col my-auto">
                                <i class="fa fa-building f-right text-white-50" style="font-size: 3rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-yellow order-card shadow">
                    <div class="card-block">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-b-20">Total Kriteria</h6>
                                <h3 class="f-left text-right">{{ $total_kriteria }}</h3>
                            </div>
                            <div class="col my-auto">
                                <i class="fa fa-file f-right text-white-50" style="font-size: 3rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 p-3">
            <div class="card rounded border">
                <div class="card-header bg-ligth">
                    Maps Sekolah
                </div>
                <div class="card-body">
                    <div id="map" class="rounded"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@php
    $showsidebar = true;    
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
        map.addControl( new L.Control.Gps( { transform: function(realGps) { 
            L.marker(realGps)
                  .bindPopup('location')
                  .addTo(map)
                  .openPopup(); 
            localStorage.setItem('latitude', realGps.lat); 
            localStorage.setItem('longitude', realGps.lng); 
        }} ) );
        const location = [(localStorage.getItem("latitude")), (localStorage.getItem("longitude"))];

        Object.keys(alternatives).forEach(function (item, key) {
            var alternative = alternatives[item];
            for (let index = 0; index < alternative.length; index++) {
              var latitude = alternative[index].latitude;
              var longitude = alternative[index].longitude;
              var name = alternative[index].nama_sekolah;
              distance = L.latLng(location).distanceTo([latitude, longitude])
              console.log(distance); 
            }
        })
    })
</script>
