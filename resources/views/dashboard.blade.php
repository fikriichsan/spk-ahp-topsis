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
                            <h3 class="f-left text-right">25</h3>
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

@endsection

@php
    $showsidebar = true;    
@endphp