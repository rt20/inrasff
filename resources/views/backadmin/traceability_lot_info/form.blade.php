@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('page-css')
<style>
    .read-only-white{
        background-color: #fff !important
    }
</style>    
@endsection

@section('breadcrumb')
@if($traceability_lot->id != null)
<li class="breadcrumb-item">
    <a 
    href="{{ 
        str_replace('App\\Models\\', '', $traceability_lot->tli_type) === 'DownStreamNotification' ?
        route('backadmin.downstreams.edit', ['downstream' => $traceability_lot->notification->id, 'focus' => 'traceability_lots']) :
        route('backadmin.upstreams.edit', ['upstream' => $traceability_lot->notification->id, 'focus' => 'traceability_lots'])
    
    }}"
    
    >{{ $traceability_lot->notification->number }}</a></li>
    @else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', ['downstream' => request()->input('notification_id'), 'focus' => 'traceability_lots']) :
        route('backadmin.upstreams.edit', ['upstream' => request()->input('notification_id'), 'focus' => 'traceability_lots'])
    
    }}"
    
    >{{ request()->input('notification_type') === 'downstream' ? 'Downstream' : 'Upstream' }} Asal</a></li>
@endif
<li class="breadcrumb-item">Keterlusuran Lot</li>
@endsection

@section('actions')
    {{-- @can('store traceability')
        @if(!$traceability_lot->id)
        <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @elseif(in_array($traceability_lot->notification->status, ['open', 'draft']))
        <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @endif
    @endcan --}}

    {{-- For Update --}}
    @if($traceability_lot->id != null)
        {{-- If Dangerous Info for Downstream --}}
        @if(str_replace('App\\Models\\', '', $traceability_lot->di_type) === 'DownStreamNotification')
            @can('store d_traceability')
                @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
                @endif
            @endcan
        {{-- If Dangerous Info for Upstream --}}
        @else
            @can('store u_traceability')
                @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
                @endif
            @endcan
        @endif

    {{-- For New Data --}}
    @else
        {{-- If Dangerous Info for Downstream --}}
        @if(request()->input('notification_type') === 'downstream')
            @can('store d_traceability')
            <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
            @endcan
        {{-- If Dangerous Info for Upstream --}}
        @else
            @can('store u_traceability')
                <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
            @endcan
        @endif


    @endif

    @if ($traceability_lot->id)
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{
                    str_replace('App\\Models\\', '', $traceability_lot->tli_type) === 'DownStreamNotification' ?
                    route('backadmin.downstreams.edit', ['downstream' => $traceability_lot->notification->id, 'focus' => 'traceability_lots']) :
                    route('backadmin.upstreams.edit', ['upstream' => $traceability_lot->notification->id, 'focus' => 'traceability_lots'])
                        }}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            {{-- @can('delete traceability')
            @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
            @endif
            @endcan   --}}

            @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                @if(str_replace('App\\Models\\', '', $traceability_lot->tli_type) === 'DownStreamNotification')
                    @can('delete d_traceability')
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                    @endcan
                @else
                    @can('delete u_traceability')
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                    @endcan
                @endif
            @endif
        </div>
    </div>
        
    @endif
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
            <form id="form-main" method="post" enctype="multipart/form-data">
                <input name="notification_type" hidden value="{{request()->input('notification_type')}}">
                <input name="notification_id" hidden value="{{request()->input('notification_id')}}">
                @csrf
                @if ($traceability_lot->id)
                    @method('PUT')
                @endif
                <section class="bi-form-main">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                                    </div>
                                
                                    <div class="row">

                            <div class="col-12 col-md-6 form-group">
                                <label for="number" class="form-label required">Nomor Batch/Lot/Consignment</label>
                                <input type="text" 
                                    name="number"
                                    v-model="traceability_lot.number" 
                                    class="form-control @error('number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nomor Batch/Lot/Consignment" autocomplete="off">
                                @error('number')
                                    <small class="text-danger">{{ $errors->first('number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                                    
                            <div class="col-12 col-md-6 form-group">
                                <label for="source_country_id" class="form-label required">Negara Asal</label>
                                <select 
                                    id="source_country_id"
                                    name="source_country_id"
                                    v-model="traceability_lot.source_country_id" 
                                    class="form-control @error('source_country_id') {{ 'is-invalid' }} @enderror" 
                                    autocomplete="off">
                                </select>
                                @error('source_country_id')
                                    <small class="text-danger">{{ $errors->first('source_country_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="divider divider-left col-12">
                                <div class="divider-text">Informasi Tanggal</div>
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label for="used_by" class="form-label ">Used-by-date</label>
                                <input type="text" 
                                    name="used_by"
                                    v-model="traceability_lot.used_by" 
                                    class="form-control @error('used_by') {{ 'is-invalid' }} @enderror date read-only-white" 
                                    placeholder="Masukkan Tanggal Used-By" autocomplete="off">
                                @error('used_by')
                                    <small class="text-danger">{{ $errors->first('used_by') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="best_before" class="form-label ">Best before date</label>
                                <input type="text" 
                                    name="best_before"
                                    v-model="traceability_lot.best_before" 
                                    class="form-control @error('best_before') {{ 'is-invalid' }} @enderror date read-only-white" 
                                    placeholder="Masukkan Tanggal Best Before" autocomplete="off">
                                @error('best_before')
                                    <small class="text-danger">{{ $errors->first('best_before') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="sell_by" class="form-label ">Sell-by-date</label>
                                <input type="text" 
                                    name="sell_by"
                                    v-model="traceability_lot.sell_by" 
                                    class="form-control @error('sell_by') {{ 'is-invalid' }} @enderror date read-only-white" 
                                    placeholder="Masukkan Tanggal Sell By" autocomplete="off">
                                @error('sell_by')
                                    <small class="text-danger">{{ $errors->first('sell_by') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="divider divider-left col-12">
                                <div class="divider-text">Keterangan Terkait Lot</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="number_unit" class="form-label ">No Of Units</label>
                                <input type="text" 
                                    name="number_unit"
                                    v-model="traceability_lot.number_unit" 
                                    class="form-control @error('number_unit') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan No Of Units" autocomplete="off">
                                @error('number_unit')
                                    <small class="text-danger">{{ $errors->first('number_unit') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="net_weight" class="form-label ">Total (net) weight / volume of lot</label>
                                <div class="input-group form-password-toggle mb-2">
                                    <input type="text" 
                                        name="net_weight"
                                        v-model="traceability_lot.net_weight" 
                                        class="form-control @error('net_weight') {{ 'is-invalid' }} @enderror" 
                                        placeholder="Masukkan Total (net) weight / volume of lot" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer">Kg</span>
                                    </div>
                                </div>
                                @error('net_weight')
                                    <small class="text-danger">{{ $errors->first('net_weight') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Sertifikat Kesehatan</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="cert_number" class="form-label ">Nomor</label>
                                <input type="text" 
                                    name="cert_number"
                                    v-model="traceability_lot.cert_number" 
                                    class="form-control @error('cert_number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nomor" autocomplete="off">
                                @error('cert_number')
                                    <small class="text-danger">{{ $errors->first('cert_number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="cert_date" class="form-label ">Tanggal</label>
                                <input type="text" 
                                    name="cert_date"
                                    v-model="traceability_lot.cert_date" 
                                    class="form-control @error('cert_date') {{ 'is-invalid' }} @enderror date read-only-white" 
                                    placeholder="Masukkan Tanggal" autocomplete="off">
                                @error('cert_date')
                                    <small class="text-danger">{{ $errors->first('cert_date') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="cert_institution" class="form-label ">Lembaga Pemberi</label>
                                <input type="text" 
                                    name="cert_institution"
                                    v-model="traceability_lot.cert_institution" 
                                    class="form-control @error('cert_institution') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Lembaga Pemberi" autocomplete="off">
                                @error('cert_institution')
                                    <small class="text-danger">{{ $errors->first('cert_institution') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="divider divider-left col-12">
                                <div class="divider-text">Sertifikat Lainnya</div>
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label for="add_cert_number" class="form-label ">Nomor</label>
                                <input type="text" 
                                    name="add_cert_number"
                                    v-model="traceability_lot.add_cert_number" 
                                    class="form-control @error('add_cert_number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nomor" autocomplete="off">
                                @error('add_cert_number')
                                    <small class="text-danger">{{ $errors->first('add_cert_number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="add_cert_date" class="form-label ">Tanggal</label>
                                <input type="text" 
                                    name="add_cert_date"
                                    v-model="traceability_lot.add_cert_date" 
                                    class="form-control @error('add_cert_date') {{ 'is-invalid' }} @enderror date read-only-white" 
                                    placeholder="Masukkan Tanggal" autocomplete="off">
                                @error('add_cert_date')
                                    <small class="text-danger">{{ $errors->first('add_cert_date') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="add_cert_institution" class="form-label ">Lembaga Pemberi</label>
                                <input type="text" 
                                    name="add_cert_institution"
                                    v-model="traceability_lot.add_cert_institution" 
                                    class="form-control @error('add_cert_institution') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Lembaga Pemberi" autocomplete="off">
                                @error('add_cert_institution')
                                    <small class="text-danger">{{ $errors->first('add_cert_institution') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            @if($traceability_lot->id)
                            <div class="col-12 col-md-12 form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="laboratorium" class="form-label ">Daftar Negara Terdistribusi</label>
                                    @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                                    <button type="button" v-on:click="openDistributionModal('add', null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                    @endif
                                </div>
                                <table v-cloak id="table-distribution" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Negara</th>
                                            @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                                            <th class="bi-table-col-action-1">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- .col-md-6.form-group -->
                            @endif

                            <div class="col-12 col-md-12 form-group">
                                <label for="cved_number" class="form-label ">CVED/CED Number</label>
                                <input type="text" 
                                    name="cved_number"
                                    v-model="traceability_lot.cved_number" 
                                    class="form-control @error('cved_number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan CVED/CED Number" autocomplete="off">
                                @error('cved_number')
                                    <small class="text-danger">{{ $errors->first('cved_number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="divider divider-left col-12">
                                <div class="divider-text">Produsen</div>
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="producer_name" class="form-label ">Nama</label>
                                <input type="text" 
                                    name="producer_name"
                                    v-model="traceability_lot.producer_name" 
                                    class="form-control @error('producer_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama" autocomplete="off">
                                @error('producer_name')
                                    <small class="text-danger">{{ $errors->first('producer_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            

                            <div class="col-12 col-md-12 form-group">
                                <label for="producer_name" class="form-label ">Alamat</label>
                                <textarea
                                    name="producer_address"
                                    v-model="traceability_lot.producer_address"
                                    class="form-control @error('producer_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Alamat" autocomplete="off"
                                ></textarea>
                                @error('producer_name')
                                    <small class="text-danger">{{ $errors->first('producer_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            

                            <div class="col-12 col-md-6 form-group">
                                <label for="producer_city" class="form-label ">Kota</label>
                                <input type="text" 
                                    name="producer_city"
                                    v-model="traceability_lot.producer_city" 
                                    class="form-control @error('producer_city') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Kota" autocomplete="off">
                                @error('producer_city')
                                    <small class="text-danger">{{ $errors->first('producer_city') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="producer_country_id" class="form-label ">Negara</label>
                                <select 
                                    id="producer_country_id"
                                    name="producer_country_id"
                                    v-model="traceability_lot.producer_country_id" 
                                    class="form-control @error('producer_country_id') {{ 'is-invalid' }} @enderror" 
                                    autocomplete="off">
                                </select>
                                @error('producer_country_id')
                                    <small class="text-danger">{{ $errors->first('producer_country_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="producer_approval" class="form-label ">Approval / reg.number</label>
                                <input type="text" 
                                    name="producer_approval"
                                    v-model="traceability_lot.producer_approval" 
                                    class="form-control @error('producer_approval') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Approval Reg.Number" autocomplete="off">
                                @error('producer_approval')
                                    <small class="text-danger">{{ $errors->first('producer_approval') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Importir</div>
                            </div>
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="importer_name" class="form-label ">Nama</label>
                                <input type="text" 
                                    name="importer_name"
                                    v-model="traceability_lot.importer_name" 
                                    class="form-control @error('importer_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama" autocomplete="off">
                                @error('importer_name')
                                    <small class="text-danger">{{ $errors->first('importer_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="importer_name" class="form-label ">Alamat</label>
                                <textarea
                                    name="importer_address"
                                    v-model="traceability_lot.importer_address"
                                    class="form-control @error('importer_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Alamat" autocomplete="off"
                                ></textarea>
                                @error('importer_name')
                                    <small class="text-danger">{{ $errors->first('importer_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="importer_city" class="form-label ">Kota</label>
                                <input type="text" 
                                    name="importer_city"
                                    v-model="traceability_lot.importer_city" 
                                    class="form-control @error('importer_city') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Kota" autocomplete="off">
                                @error('importer_city')
                                    <small class="text-danger">{{ $errors->first('importer_city') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="importer_country_id" class="form-label ">Negara</label>
                                <select 
                                    id="importer_country_id"
                                    name="importer_country_id"
                                    v-model="traceability_lot.importer_country_id" 
                                    class="form-control @error('importer_country_id') {{ 'is-invalid' }} @enderror" 
                                    autocomplete="off">
                                </select>
                                @error('importer_country_id')
                                    <small class="text-danger">{{ $errors->first('importer_country_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="importer_approval" class="form-label ">Approval / reg.number</label>
                                <input type="text" 
                                    name="importer_approval"
                                    v-model="traceability_lot.importer_approval" 
                                    class="form-control @error('importer_approval') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Approval Reg.Number" autocomplete="off">
                                @error('importer_approval')
                                    <small class="text-danger">{{ $errors->first('importer_approval') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Wholesaler</div>
                            </div>
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="wholesaler_name" class="form-label ">Nama</label>
                                <input type="text" 
                                    name="wholesaler_name"
                                    v-model="traceability_lot.wholesaler_name" 
                                    class="form-control @error('wholesaler_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama" autocomplete="off">
                                @error('wholesaler_name')
                                    <small class="text-danger">{{ $errors->first('wholesaler_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="wholesaler_name" class="form-label ">Alamat</label>
                                <textarea
                                    name="wholesaler_address"
                                    v-model="traceability_lot.wholesaler_address"
                                    class="form-control @error('wholesaler_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Alamat" autocomplete="off"
                                ></textarea>
                                @error('wholesaler_name')
                                    <small class="text-danger">{{ $errors->first('wholesaler_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="wholesaler_city" class="form-label ">Kota</label>
                                <input type="text" 
                                    name="wholesaler_city"
                                    v-model="traceability_lot.wholesaler_city" 
                                    class="form-control @error('wholesaler_city') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Kota" autocomplete="off">
                                @error('wholesaler_city')
                                    <small class="text-danger">{{ $errors->first('wholesaler_city') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="wholesaler_country_id" class="form-label ">Negara</label>
                                <select 
                                    id="wholesaler_country_id"
                                    name="wholesaler_country_id"
                                    v-model="traceability_lot.wholesaler_country_id" 
                                    class="form-control @error('wholesaler_country_id') {{ 'is-invalid' }} @enderror" 
                                    autocomplete="off">
                                </select>
                                @error('wholesaler_country_id')
                                    <small class="text-danger">{{ $errors->first('wholesaler_country_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="wholesaler_approval" class="form-label ">Approval / reg.number</label>
                                <input type="text" 
                                    name="wholesaler_approval"
                                    v-model="traceability_lot.wholesaler_approval" 
                                    class="form-control @error('wholesaler_approval') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Approval Reg.Number" autocomplete="off">
                                @error('wholesaler_approval')
                                    <small class="text-danger">{{ $errors->first('wholesaler_approval') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
                <div class="modal fade" id="distribution-modal" tabindex="-1" role="dialog" aria-labelledby="modalAddsampling" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="distribution-modal-form" action="#" method="GET">                    
                                <div class="modal-header">
                                    <h4 v-show="distributionModal.state !== 'delete'" class="modal-title" id="modalAddsampling">Tambah Negara</h4>
                                    <h4 v-show="distributionModal.state === 'delete'" class="modal-title" id="modalAddsampling">Konfirmasi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" v-show="distributionModal.state !== 'delete'">
                                        <div class="col-12 col-md-12 form-group" >
                                            <label for="distribution_country" class="form-label ">Negara</label>
                                            <select 
                                                id="distribution_country"
                                                name="distribution_country"
                                                v-model="traceability_lot.distribution_country" 
                                                class="form-control @error('distribution_country') {{ 'is-invalid' }} @enderror" 
                                                autocomplete="off">
                                            </select>
                                        </div>
                                    </div>
                
                                    <div v-show="distributionModal.state === 'delete'">
                                        <p class="mb-0">Apakah Anda yakin akan menghapus Negara Ini ini?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button v-if="distributionModal.state !== 'delete'" type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                    <button v-if="distributionModal.state !== 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Tambahkan</button>
                                    <button v-if="distributionModal.state === 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-outline-primary">Ya, Hapus</button>
                                    <button v-if="distributionModal.state === 'delete'"  type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($traceability_lot->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.traceability_lot_infos.destroy', $traceability_lot->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Keterlusuran Lot ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endpush

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
@endsection

@push('page-js')
@include('backadmin.traceability_lot_info.script')
@endpush