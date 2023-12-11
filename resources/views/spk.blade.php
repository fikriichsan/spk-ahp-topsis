@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
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
        <div class="row justify-content-centerr">
            <div class="col-12">
                <form action="/rekomendasi" method="POST">
                    @csrf
                    <input type="text" name="longitude" id="longitude" hidden>
                    <input type="text" name="latitude" id="latitude" hidden>
                    <button class="btn btn-primary" id="myButton" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
</div>
    
@endsection

@php
    $showsidebar = true;
    $showNavbar = false;
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
            document.querySelector("#latitude").value = realGps.lat; 
            document.querySelector("#longitude").value = realGps.lng;
            localStorage.setItem("latitude", realGps.lat);  
            localStorage.setItem("longitude", realGps.lng);  
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
