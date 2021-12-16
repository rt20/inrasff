<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="Inrasff">
        <meta name="keywords" content="bpom inrasff notifikasi bpom">
        <meta name="author" content="PENTACODE">
        <title>{{ config('app.name') }} | {{ $title ?? 'Report Notifikasi' }}</title>
        <link rel="apple-touch-icon" href="{{ asset('backadmin/theme/images/ico/apple-icon-120.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backadmin/theme/images/ico/favicon.ico') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/core.css')) }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/app/css/style.css') }}">
    </head>
    <body onload="window.print()" class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="invoice-print p-3">
                        <div class="d-flex justify-content-between flex-md-row flex-column">
                            <div>
                                <div class="d-flex mb-1 bg-primary p-1 w-100">
                                    <img src="{{asset('images/inrasff.png')}}" style="width: 70%!important">
                                </div>
                                <p class="mb-25"><b>Notification Link: </b><a href="{{$url ?? '#'}}" target="_blank">{{$url ?? '-'}}</a></p>
                                <p class="mb-25">{{$notification->number ?? '-'}}</p>
                            </div>
                        </div>
    
                        <hr class="my-2" />
    
    
                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">I. Informasi Umum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">01. Nomor Referensi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->number ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">02. Status Notifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->notificationStatus->name ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">03. Tipe Notifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->notificationType->name ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">04. Judul Notifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->title ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">05. Negara yang menotifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->country->name ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">06. Dasar Notifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->baseNotification->name ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">07. Sumber Informasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->source_notif && $notification->origin_source_notif ? ($notification->origin_source." (".$notification->source.")") : '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">08. Tanggal Notifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->created_at ? \Carbon\Carbon::make($notification->created_at)->isoFormat('dddd, D MMMM Y') : '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">09. Instansi yang perlu menindaklanjuti</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">10. Instansi lain yang terkait</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">II. Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">11. Nama Produk</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->product_name?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">12. Kategori Produk</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->product_category ?? '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="3">
                                            <p class="font-weight-semibold mb-25">13. Deskripsi Produk</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Merk Produk: {{$notification->brand_name?? '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Kemasan Produk: {{$notification->package_product?? '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Nomor Registrasi: {{$notification->registration_number?? '-'}}</p>
                                        </td>
                                    </tr>
                                    {{-- <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Berat Unit:</p>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">III. Bahaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($notification->dangerous)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Bahaya Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                    @foreach ($notification->dangerous as $i=>$item)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">{{$alphabet[$i]}}. Bahaya</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">14.{{$alphabet[$i]}}. Jenis Bahaya yang diidentifikasi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->name ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">15.{{$alphabet[$i]}}. Kategori Bahaya</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->category->name ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    {{-- <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">16.{{$alphabet[$i]}}. Hasil Uji</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->name_result ?? "-"}}</strong>
                                        </td>
                                    </tr> --}}
                                    @if(sizeof($item->sampling)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Sampling Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                    @foreach ($item->sampling as $k=>$sampling)
                                        
                                    <tr class="border-bottom">
                                        <tr>
                                            <td colspan="2" class="py-1 pl-4 text-center">Sampling {{$k+1}}</td>
                                        </tr>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Tanggal</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->sampling_date ? \Carbon\Carbon::make($sampling->sampling_date)->isoFormat('dddd, D MMMM Y') : '-'}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Jumlah Sampel</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->sampling_count ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Metode</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->sampling_method ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Tempat pengambilan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->sampling_place ?? "-"}}</strong>
                                        </td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Hasil Uji</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->name_result ?? "-"}}</strong>
                                        </td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Satuan Hasil Uji</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->uom_result_id ? $sampling->uom->name : "-"}}</strong>
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr class="border-bottom">
                                        <td class="py-1 pl-4" colspan="2">
                                            <p class="font-weight-semibold mb-25">18.{{$alphabet[$i]}}. Analisis</p>
                                        </td>
                                    </tr> --}}
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Laboratorium</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->laboratorium ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Matriks</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->matrix ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    {{-- <tr class="border-bottom">
                                        <td class="py-1 pl-4" colspan="2">
                                            <p class="font-weight-semibold mb-25">19.{{$alphabet[$i]}}. Standar yang berlaku</p>
                                        </td>
                                    </tr> --}}
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Scope</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->scope ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Maksimum batas yang diijinkan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$sampling->max_tollerance ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">IV. Resiko</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($notification->risks)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Resiko Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                    @foreach ($notification->risks as $i=>$item)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">{{$alphabet[$i]}}. Resiko</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25"> 20.{{$alphabet[$i]}}. Status distribusi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->distributionStatus->name ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">21.{{$alphabet[$i]}}. Resiko Serius</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->serious_risk ?? '-' }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">22.{{$alphabet[$i]}}. Jumlah korban</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->victim ?? '-' }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">23.{{$alphabet[$i]}}. Sakit yang di derita/gejala</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->symptom ?? '-' }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">24.{{$alphabet[$i]}}. Voluntary Measures</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">25.{{$alphabet[$i]}}. Compulsory Measures</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">26. {{$alphabet[$i]}}. Tanggal dikeluarkan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->created_at ? \Carbon\Carbon::make($notification->created_at)->isoFormat('dddd, D MMMM Y') : '-'}}</strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">V. Keterlusuran Lot</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(sizeof($notification->traceabilityLot)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Keterlusuran Lot Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                @foreach ($notification->traceabilityLot as $i=>$item)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">{{$alphabet[$i]}}. Keterlusuran Lot</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">27.{{$alphabet[$i]}}. Negara Asal</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->sourceCountry->name ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">28.{{$alphabet[$i]}}. Nomor Batch/ Lot/ Consigment</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{ $item->number ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="3">
                                            <p class="font-weight-semibold mb-25">29.{{$alphabet[$i]}}. Informasi Tanggal</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Used-by-date: {{$item->used_by ? \Carbon\Carbon::make($item->used_by)->isoFormat('dddd, D MMMM Y') : '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Best-before-date: {{$item->best_before ? \Carbon\Carbon::make($item->best_before)->isoFormat('dddd, D MMMM Y') : '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Sell-by-date: {{$item->sell_by ? \Carbon\Carbon::make($item->sell_by)->isoFormat('dddd, D MMMM Y') : '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="2">
                                            <p class="font-weight-semibold mb-25">30.{{$alphabet[$i]}}. Deskripsi Lot</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">No of Units: {{$item->number_unit ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Total (net) weight / volume of lot: {{$item->net_weight ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="3">
                                            <p class="font-weight-semibold mb-25">31.{{$alphabet[$i]}}. Sertifikat Kesehatan (Public Health Certificate)</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Number: {{$item->cert_number ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Date: {{$item->cert_date ? \Carbon\Carbon::make($item->cert_date)->isoFormat('dddd, D MMMM Y') : '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Organization / ministry: {{$item->cert_institution ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="3">
                                            <p class="font-weight-semibold mb-25">32.{{$alphabet[$i]}}. Sertifikat lainnya</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Number: {{$item->add_cert_number ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Date: {{$item->add_cert_date ? \Carbon\Carbon::make($item->add_cert_date)->isoFormat('dddd, D MMMM Y') : '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Organization / ministry: {{$item->add_cert_institution ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">33.{{$alphabet[$i]}}. CVED/CED Number</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">{{$item->cved_number ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="5">
                                            <p class="font-weight-semibold mb-25">34.{{$alphabet[$i]}}. Produsen</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Nama: {{$item->producer_name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Alamat: {{$item->producer_address ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Kota: {{$item->producer_city ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Negara: {{$item->producerCountry->name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Approval / reg.number: {{$item->producer_approval ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="5">
                                            <p class="font-weight-semibold mb-25">35.{{$alphabet[$i]}}. Importir</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Nama: {{$item->importer_name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Alamat: {{$item->importer_address ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Kota: {{$item->importer_city ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Negara: {{$item->importerCountry->name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Approval / reg.number: {{$item->importer_approval ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="5">
                                            <p class="font-weight-semibold mb-25">36.{{$alphabet[$i]}}. Wholesaler</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Nama: {{$item->wholesaler_name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Alamat: {{$item->wholesaler_address ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Kota: {{$item->wholesaler_city ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Negara: {{$item->wholesalerCountry->name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Approval / reg.number: {{$item->wholesaler_approval ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">37.{{$alphabet[$i]}}. Distribusi ke Negara ASEAN</p>
                                        </td>
                                        
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">                                                
                                                @foreach ($item->distributions as $i => $c)
                                                    @if($c->country->is_asean)
                                                        {{$c->country->name." "}}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">38.{{$alphabet[$i]}}. Ekspor ke Negara Lainnya</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">
                                                @foreach ($item->distributions as $i => $c)
                                                    @if(!$c->country->is_asean)
                                                        {{$c->country->name." "}}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">VI. Border Control</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(sizeof($notification->borderControl)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Border Control Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                    @foreach ($notification->borderControl as $i=>$item)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">{{$alphabet[$i]}}. Border Control</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">39.{{$alphabet[$i]}}. Titik Keberangkatan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->start_point ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">40.{{$alphabet[$i]}}. Titik Masuk</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->entry_point ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">41.{{$alphabet[$i]}}. Titik Pengawasan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->supervision_point ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">42.{{$alphabet[$i]}}. Negara Tujuan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->destinationCountry->name ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="2">
                                            <p class="font-weight-semibold mb-25">43.{{$alphabet[$i]}}. Consignee/ Penerima</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Nama: {{$item->consignee_name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Alamat: {{$item->consignee_address ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">44.{{$alphabet[$i]}}. Container / Seal Number</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->container_number ?? "-" }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" rowspan="2">
                                            <p class="font-weight-semibold mb-25">45.{{$alphabet[$i]}}. Alat Transportasi</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">{{$item->transport_name ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1">
                                            <p class="font-weight-semibold mb-25">Informasi Lainnya: {{$item->transport_description ?? "-" }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">VII. Informasi Lainnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">46. Instansi</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->institution ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">47. Contact Person</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->contact_person ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">48. Informasi Lainnya</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$notification->others ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="py-1 pl-4 text-center">VIII. Lampiran Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($notification->attachment)<1)
                                    <tr>
                                        <td colspan="2" class="py-1 pl-4 text-center">Lampiran Tidak Tersedia</td>
                                    </tr>
                                    @endif
                                    @foreach($notification->attachment as $i => $attachment)
                                    <tr>
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25"><a href="{{$attachment->origin?? "#"}}" target="_blank">{{$attachment->link}}</a></p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-2" />
    
                        <div class="row">
                            <div class="col-12">
                                <span class="font-weight-bold">Note:</span>
                                <span>Silahkan periksa kembali data notifikasi! Apabila terdapat kekeliruan silahkan hubungi admin.</span>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        <!-- END: Content-->
    
    </body>
</html>