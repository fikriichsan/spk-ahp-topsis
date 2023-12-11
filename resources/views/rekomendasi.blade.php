@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center"> 
        <div class="col-12">
            <div class="table-responsive bg-white border rounded-4">
                <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">NPSN</th>
                            <th scope="col">Akreditasi</th>
                            <th scope="col">Nilai Akhir</th>
                            <th scope="col">Ranking</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $item)
                                <tr>
                                    <td class="align-middle" style="table-layout: fixed">{{ $item['nama_sekolah'] }}</td>
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
    $showsidebar = true;
    $showNavbar = false;
@endphp