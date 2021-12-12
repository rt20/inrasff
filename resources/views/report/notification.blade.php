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
                                <div class="d-flex mb-1">
                                    <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                        <defs>
                                            <linearGradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                <stop stop-color="#000000" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                            <linearGradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                                    <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                    <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <h3 class="text-primary font-weight-bold ml-1">Formulir Notifikasi</h3>
                                </div>
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
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25">16.{{$alphabet[$i]}}. Hasil Uji</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->name_result ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" colspan="2">
                                            <p class="font-weight-semibold mb-25">17.{{$alphabet[$i]}}. Sampling</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Tanggal</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Jumlah Sampel</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Metode</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Tempat pengambilan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>-</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" colspan="2">
                                            <p class="font-weight-semibold mb-25">18.{{$alphabet[$i]}}. Analisis</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Laboratorium</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->laboratorium ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Matriks</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->matrix ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4" colspan="2">
                                            <p class="font-weight-semibold mb-25">19.{{$alphabet[$i]}}. Standar yang berlaku</p>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Scope</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->scope ?? "-"}}</strong>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="py-1 pl-4">
                                            <p class="font-weight-semibold mb-25 ml-4">Maksimum batas yang diijinkan</p>
                                        </td>
                                        <td class="py-1">
                                            <strong>{{$item->max_tollerance ?? "-"}}</strong>
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
                                            <p class="font-weight-semibold mb-25">{{$attachment->link}}</p>
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