@extends('backadmin.layouts.master')

@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/charts/apexcharts.css') }}">
@endsection
@section('page-css')
    @include('backadmin.layouts.style_datatables')
    <style>
        .card-browser-states .browser-states:first-child {
            margin-top: 0;
        }
        .card-browser-states .browser-states:not(:first-child) {
            margin-top: 1.7rem;
        }
        .card-congratulations .congratulations-img-right {
            width: 45%!important;
            position: absolute;
            top: 0;
            right: 0;
        }
        .card-congratulations .congratulations-img-left {
            width: 45%!important;
            position: absolute;
            top: 0;
            right: 0;
        }
        .read-only-white{
            background-color: #fff !important
        }

        .img-sld{
            width: 100%!important;
            height: 330px!important;
            object-fit: cover
        }
    </style>
@endsection
@section('content')
    <section id="dashboard">
        <div class="row match-height">
            <!-- Greetings Card starts -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="{{ asset('backadmin/app/img/decore-left.png') }}"
                            class="congratulations-img-left" alt="card-img-left" />
                        <img src="{{ asset('backadmin/app/img/decore-right.png') }}"
                            class="congratulations-img-right" alt="card-img-right" />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Dashboard</h1>
                            <p class="card-text m-auto w-75">
                                Rangkuman Data INRASFF
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Greetings Card ends -->

            <!-- Subscribers Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="navigation" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">92.2K</h2>
                        <p class="card-text">Isu Nasional</p>
                    </div>
                    <div id="gained-chart"></div>
                </div>
            </div>
            <!-- Subscribers Chart Card ends -->

            <!-- Orders Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="globe" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">38.5K</h2>
                        <p class="card-text">Isu Internasional</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
            <!-- Orders Chart Card ends -->
        </div>
        <div class="row match-height">
            <!-- Avg Sessions Chart Card starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div
                                class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                <div class="mb-1 mb-sm-0">
                                    <h2 class="font-weight-bolder mb-25">2.7K</h2>
                                    <p class="card-text font-weight-bold mb-2">Rata-rata Isu</p>
                                    <div class="font-medium-2">
                                        <span class="text-success mr-25">+5.2%</span>
                                        <span>vs Agustus 2021</span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary">Selengkapnya</button>
                            </div>
                            <div
                                class="col-sm-6 col-12 d-flex justify-content-between flex-column text-right order-sm-2 order-1">
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button"
                                        id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{date('F Y')}}
                                    </button>
                                    {{-- <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownItem5">
                                        <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                    </div> --}}
                                </div>
                                <div id="avg-sessions-chart"></div>
                            </div>
                        </div>
                        <hr />
                        <div class="row avg-sessions pt-50">
                            <div class="col-6 mb-2">
                                <p class="mb-50">Kesehatan: 100.000 <span class="text-danger mr-25">( -50.2%)</span></p>
                                <div class="progress progress-bar-primary" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <p class="mb-50">Pangan: 123.020 <span class="text-success mr-25">( 10.2%)</span></p>
                                <div class="progress progress-bar-warning" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="mb-50">Obat-obatan: 349.120</p>
                                <div class="progress progress-bar-danger" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="mb-50">Lainnya: 802.000</p>
                                <div class="progress progress-bar-success" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90"
                                        aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Avg Sessions Chart Card ends -->

            <!-- Support Tracker Chart Card starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Statistik Kasus</h4>
                        <div class="dropdown chart-dropdown">
                            <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button"
                                id="dropdownItem4" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{date('F Y')}}
                            </button>
                            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem4">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">163</h1>
                                <p class="card-text">Total Kasus</p>
                            </div>
                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                <div id="support-trackers-chart"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="text-center">
                                <p class="card-text mb-50">Kasus Baru</p>
                                <span class="font-large-1 font-weight-bold">29</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Kasus Ditindak Lanjut</p>
                                <span class="font-large-1 font-weight-bold">63</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Kasus Selesai</p>
                                <span class="font-large-1 font-weight-bold">72</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Tracker Chart Card ends -->
        </div>

    </section>    
@endsection

@section('vendor-js')
<script src="{{ asset('backadmin/theme/vendors/js/charts/apexcharts.min.js') }}"></script>
@endsection

@push('page-js')
@include('backadmin.dashboard.dashboard_script')
@endpush