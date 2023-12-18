@extends('layouts.main')

@section('container')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <form action="/alternatif" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-8" style="padding-left: 0">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Masukan Nama Sekolah">
                    </div>
                    <div class="col-4 p-0">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="Masukan NPSN">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-9" style="padding-left: 0">
                        <label for="alamat" class="form-label">Alamat Sekolah</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukan Alamat Sekolah">
                    </div>
                    <div class="col mb-3 p-0">
                        <label for="akreditasi" class="form-label">Akreditasi</label>
                        <input class="form-control @error('akreditasi') is-invalid @enderror" name="akreditasi" id="akreditasi" placeholder="Masukan Nilai AKreditasi Sekolah">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 p-0">
                        <label for="contact" class="form-label">Kontak</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" placeholder="Masukan Nomor Telepon">
                    </div>
                    <div class="col-4">
                        <label for="instagram" class="form-label">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" id="contact" placeholder="Masukan Username">
                        </div>
                    </div>
                    <div class="col-4 p-0 mb-3">
                        <label for="website_sekolah" class="form-label">Website</label>
                        <input type="text" class="form-control @error('website_sekolah') is-invalid @enderror" name="website_sekolah" id="contact" placeholder="Masukan Nomor Telepon">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <fieldset class="border rounded-3 p-3">
                        <legend class="float-none w-auto px-3" >Fasilitas</legend>
                        <div class="row justify-content-center">
                            <div class="col-4 mb-3">
                                <label for="ruang_kelas" class="form-label">Jumlah Kelas</label>
                                <input type="text" class="form-control @error('ruang_kelas') is-invalid @enderror" name="ruang_kelas" id="ruang_kelas" placeholder="Masukan Jumlah Kelas">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="laboratorium" class="form-label">Jumlah Laboratory</label>
                                <input type="text" class="form-control @error('laboratorium') is-invalid @enderror" name="laboratorium" id="laboratorium" placeholder="Masukan Jumlah Laboratorium">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="perpustakaan" class="form-label">Jumlah Perpustakaan</label>
                                <input type="text" class="form-control @error('perpustakaan') is-invalid @enderror" name="perpustakaan" id="perpustakaan" placeholder="Masukan Jumlah Perpustakaan">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="uks" class="form-label">UKS</label>
                                <input  class="form-control @error('uks') is-invalid @enderror" name="uks" id="uks" placeholder="Masukan Jumlah UKS">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="sanitasi" class="form-label">Sanitasi</label>
                                <input  class="form-control @error('sanitasi') is-invalid @enderror" name="sanitasi" id="sanitasi" placeholder="Masukan jumlah sanitasi">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="tempat_ibadah" class="form-label">Tempat Ibadah</label>
                                <input class="form-control @error('tempat_ibadah') is-invalid @enderror" name="tempat_ibadah" id="tempat_ibadah" placeholder="Masukan Jumlah Tempat Ibadah">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="sarana_olahraga" class="form-label">Sarana Olahraga</label>
                                <input class="form-control @error('sarana_olahraga') is-invalid @enderror" name="sarana_olahraga" placeholder="Masukan Jumlah Sarana">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="guru" class="form-label">Jumlah Guru</label>
                                <input class="form-control @error('guru') is-invalid @enderror" id="guru" name="guru" placeholder="Masukan Jumlah guru">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="ekstrakulikuler" class="form-label">Ekstrakulikuler</label>
                                <input class="form-control @error('ekstrakulikuler') is-invalid @enderror" name="ekstrakulikuler" placeholder="Masukan Jumlah Ekstrakulikuler">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="border rounded-3 p-3">
                        <legend class="float-none w-auto px-3">Biaya</legend>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="biaya_masuk" class="form-label">Uang Pangkal</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control @error('biaya_masuk') is-invalid @enderror" name="biaya_masuk" id="biaya_masuk" placeholder="Masukan Nomor Telepon">
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="biaya_spp" class="form-label">Biaya SPP</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control @error('biaya_spp') is-invalid @enderror" name="biaya_spp" id="biaya_spp" placeholder="Masukan Nomor Telepon">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="border rounded-3 p-3">
                        <legend class="float-none w-auto px-3" >Lokasi</legend>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input class="form-control" name="longitude" placeholder="Masukan Longitude">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input class="form-control" name="latitude" placeholder="Masukan Latitude">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-primary" type="submit">Tambah Sekolah</button>
                        <a href="/alternatif" class="btn btn-outline-primary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection

@php
    $showsidebar =true
@endphp