@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-sm-12 col-xl-10">
      <a href="/alternatif/create" class="btn btn-outline-primary mb-3"><i class="bi bi-plus-lg"></i>Tambah Alternatif</a>
      <div class="table-responsive bg-white border rounded-4">
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nama Sekolah</th>
                    <th scope="col">NPSN</th>
                    <th scope="col">Akreditasi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif as $item)
                        <tr>
                            <td class="align-middle" style="text-align: justify">{{ $item->nama_sekolah }}</td>
                            <td class="align-middle">{{ $item->npsn }}</td>
                            <td class="align-middle">{{ $item->akreditasi }}</td>
                            <td class="align-middle" style="text-align: justify; min-width: 500px; max-width: 500px">{{ $item->alamat }}</td>
                            <td class="align-middle">
                                <div class="btn-group dropstart rounded-circle">
                                    <button class="btn btn-secondary rounded-circle" type="button" data-bs-toggle="dropdown" aria-bs-expanded="false" data-bs-boundary="window">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu position-fixed">
                                      <li><a class="dropdown-item" href="/alternatif/{{ $item->id }}/edit">Edit</a></li>
                                      <li>
                                          <form action="/alternatif/{{ $item->id }}" method="POST">
                                              @method('delete')
                                              @csrf
                                              <button class="dropdown-item" type="submit">Delete</button>
                                          </form>
                                      </li>
                                      <li><a class="dropdown-item" href="#">Detail</a></li>
                                    </ul>
                                </div>
                            </td>
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
@endphp