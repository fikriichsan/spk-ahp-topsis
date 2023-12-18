@extends('layouts.main')

@section('container')
<table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Kriteria</th>
            <th scope="col">Akreditasi</th>
            <th scope="col">Fasilitas</th>
            <th scope="col">Biaya</th>
            <th scope="col">Lokasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kriteria as $value)
            <tr>
                <th scope="col">{{ $value->name_kriteria }}</th>
                <td scope="col">{{ $value->akreditasi }}</td>
                <td scope="col">{{ $value->fasilitas }}</td>
                <td scope="col">{{ $value->biaya }}</td>
                <td scope="col">{{ $value->lokasi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Check Konsistensi
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hasil Konsistensi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Bobobot Kriteria</h5>
            <p>Akreditasi = {{ $eigen_vector[0] }} <br />
                Fasilitas = {{ $eigen_vector[1] }} <br />
                Biaya = {{ $eigen_vector[2] }} <br />
                Lokasi = {{ $eigen_vector[3] }} <br />
                CI = {{ $consistency }}
            </p>
            @if ($consistency <= 0.1)
                <p>Konsisten</p>
            @else
              <p>Tida Konsisten</p>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Kriteria</th>
            <th scope="col">Ruang Kelas</th>
            <th scope="col">Sarana Pendukung</th>
            <th scope="col">Guru</th>
            <th scope="col">Ekstrakulikuler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subKriteria_fasilitas as $value)
            <tr>
                <th scope="col">{{ $value->nama_kriteria }}</th>
                <td scope="col">{{ $value->ruang_kelas }}</td>
                <td scope="col">{{ $value->sarana_pendukung }}</td>
                <td scope="col">{{ $value->guru }}</td>
                <td scope="col">{{ $value->ekstrakulikuler }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal2">
    Check Konsistensi
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hasil Konsistensi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Bobot Sub Kriteria Fasilitas</h5>
            <p>Ruang Kelas = {{ $eigen_vector_fasilitas[0] }} <br />
                Sarana Pendukung = {{ $eigen_vector_fasilitas[1] }} <br />
                Guru = {{ $eigen_vector_fasilitas[1] }} <br />
                Ekstrakulikuler = {{ $eigen_vector_fasilitas[2] }} <br />
                CI = {{ $consistency_fasilitas }}
            </p>
            @if ($consistency_fasilitas <= 0.1)
                <p>Konsisten</p>
            @else
            <p>Konsisten</p>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <table class="table table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th scope="col">Kriteria</th>
            <th scope="col">Biaya Masuk</th>
            <th scope="col">Biaya SPP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subKriteria_biaya as $value)
            <tr>
                <th scope="col">{{ $value->nama_kriteria }}</th>
                <th scope="col">{{ $value->biaya_masuk }}</th>
                <td scope="col">{{ $value->biaya_spp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal3">
    Check Konsistensi
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hasil Konsistensi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Bobot Sub Kriteria Biaya</h5>
            <p>Biaya Masuk = {{ $eigen_vector_biaya[0] }} <br />
                Biaya SPP = {{ $eigen_vector_biaya[1] }}
            </p>
            @if ($consistency_biaya <= 0.1)
                <p>Konsisten</p>
            @else
            <p>Konsisten</p>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@php
    $showsidebar = true;
@endphp
