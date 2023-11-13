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
        @foreach ($kriteria as $i)
            <tr>
                <td>
                    nama kriteria
                </td>
                <td class="align-middle">
                    <input type="text" class="form-control" value="{{ $i->akreditasi }}">
                </td>
                <td class="align-middle">
                    <input type="text" class="form-control" value="{{ $i->fasilitas }}">
                </td>
                <td class="align-middle">
                    <input type="text" class="form-control" value="{{ $i->biaya }}">
                </td>
                <td class="align-middle">
                    <input type="text" class="form-control" value="{{ $i->lokasi }}">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@php
    $showsidebar = true;
@endphp