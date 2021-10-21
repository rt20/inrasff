@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
@if($risk->id != null)
<li class="breadcrumb-item">
    <a 
    href="{{ 
        str_replace('App\\Models\\', '', $risk->ri_type) === 'DownStreamNotification' ?
        route('backadmin.downstreams.edit', $risk->notification->id) :
        route('backadmin.upstreams.edit', $risk->notification->id)
    
    }}"
    
    >{{ $risk->notification->number }}</a></li>
    @else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', request()->input('notification_id')) :
        route('backadmin.upstreams.edit', request()->input('notification_id'))
    
    }}"
    
    >Downstream Asal</a></li>
@endif
<li class="breadcrumb-item">Info Resiko</li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $risk->id ? route('backadmin.risk_infos.update', $risk->id) : route('backadmin.risk_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($risk->id)
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
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
                    @if ($risk->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="distribution_status_id" class="form-label required">Status Distribusi</label>
                                <select 
                                    v-model="risk.distribution_status_id" 
                                    name="distribution_status_id" 
                                    id="distribution_status_id" 
                                    class="form-control @error('status_notif') {{ 'is-invalid' }} @enderror">
                                    {{-- <option value="" disabled selected>- Silahkan Pilih Status Distribusi -</option>
                                    @foreach ($a_distribution_status_id as $status)
                                    <option value="{{$status['value']}}">{{$status['label']}}</option>    
                                    @endforeach --}}
                                </select>
                                @error('distribution_status_id')
                                    <small class="text-danger">{{ $errors->first('distribution_status_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="serious_risk" class="form-label ">Resiko Serius</label>
                                <input type="text" 
                                    name="serious_risk"
                                    v-model="risk.serious_risk" 
                                    class="form-control @error('serious_risk') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Resiko Serius" autocomplete="off">
                                @error('serious_risk')
                                    <small class="text-danger">{{ $errors->first('serious_risk') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="victim" class="form-label ">Jumlah Korban</label>
                                <input type="number" 
                                    name="victim"
                                    v-model="risk.victim" 
                                    class="form-control @error('victim') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Jumlah Korban" autocomplete="off">
                                @error('victim')
                                    <small class="text-danger">{{ $errors->first('victim') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="symptom" class="form-label ">Sakit yang di derita/gejala</label>
                                <input type="text" 
                                    name="symptom"
                                    v-model="risk.symptom"
                                    class="form-control @error('symptom') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Gejala" autocomplete="off">
                                @error('symptom')
                                    <small class="text-danger">{{ $errors->first('symptom') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            {{-- @{{risk.voluntary_measures}}
                            @{{risk.voluntary_measures_type}}
                            @{{risk.add_voluntary_measures}} --}}
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Voluntary Measures</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="voluntary_measures" class="form-label">Voluntary Measures</label>
                                <select 
                                    v-model="risk.voluntary_measures" 
                                    name="voluntary_measures" 
                                    id="voluntary_measures" 
                                    class="form-control @error('voluntary_measures') {{ 'is-invalid' }} @enderror select2">
                                    <option value="" disabled selected>- Silahkan Pilih Voluntary Measures -</option>
                                    @foreach ($a_measure as $key => $measure)
                                    <option value="{{$key}}" data-add-form="{{$measure['add_form']}}">{{$measure['label']}}</option>    
                                    @endforeach
                                </select>
                                @error('voluntary_measures')
                                    <small class="text-danger">{{ $errors->first('voluntary_measures') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group" v-show="risk.voluntary_measures_type !== ''">
                                <label for="add_voluntary_measures" class="form-label">Info Voluntary Measures</label>
                                <input 
                                    v-model="risk.add_voluntary_measures" 
                                    name="add_voluntary_measures" 
                                    :disabled="risk.voluntary_measures_type !== 'input'"
                                    v-show="risk.voluntary_measures_type === 'input'" 
                                    class="form-control" 
                                    placeholder="Silahkan Masukan Info Voluntary Measures">
                                <div v-show="risk.voluntary_measures_type === 'select' && risk.voluntary_measures === 'product to-be' ">
                                    <select 
                                        v-model="risk.add_voluntary_measures" 
                                        name="add_voluntary_measures" 
                                        :disabled="risk.voluntary_measures_type !== 'select' && risk.voluntary_measures !== 'product to-be' "
                                        class="form-control @error('add_voluntary_measures') {{ 'is-invalid' }} @enderror select2" >
                                        <option value="" disabled selected>- Silahkan Pilih Info Voluntary Measures -</option>
                                        @foreach ($a_product_to_be as $value)
                                        <option value="{{$value}}">{{ucfirst($value)}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                <div v-show="risk.voluntary_measures_type === 'select' && risk.voluntary_measures === 'physical treatment' ">
                                    <select 
                                        v-model="risk.add_voluntary_measures" 
                                        name="add_voluntary_measures" 
                                        :disabled="risk.voluntary_measures_type !== 'select' && risk.voluntary_measures !== 'physical treatment' "
                                        class="form-control @error('add_voluntary_measures') {{ 'is-invalid' }} @enderror select2">
                                        <option value="" disabled selected>- Silahkan Pilih Info Voluntary Measures -</option>
                                        @foreach ($a_physical_treatment as $value)
                                        <option value="{{$value}}">{{ucfirst($value)}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                @error('add_voluntary_measures')
                                    <small class="text-danger">{{ $errors->first('add_voluntary_measures') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            {{-- @{{risk.compulsory_measures}}
                            @{{risk.compulsory_measures_type}}
                            @{{risk.add_compulsory_measures}} --}}
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Compulsory Measures</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="compulsory_measures" class="form-label">Compulsory Measures</label>
                                <select 
                                    v-model="risk.compulsory_measures" 
                                    name="compulsory_measures" 
                                    id="compulsory_measures" 
                                    class="form-control @error('compulsory_measures') {{ 'is-invalid' }} @enderror select2">
                                    <option value="" disabled selected>- Silahkan Pilih Compulsory Measures -</option>
                                    @foreach ($a_measure as $key => $measure)
                                    <option value="{{$key}}" data-add-form="{{$measure['add_form']}}">{{$measure['label']}}</option>    
                                    @endforeach
                                </select>
                                @error('compulsory_measures')
                                    <small class="text-danger">{{ $errors->first('compulsory_measures') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group" v-show="risk.compulsory_measures_type !== ''">
                                <label for="add_compulsory_measures" class="form-label">Info Compulsory Measures</label>
                                <input 
                                    v-model="risk.add_compulsory_measures" 
                                    name="add_compulsory_measures" 
                                    :disabled="risk.compulsory_measures_type !== 'input'"
                                    v-show="risk.compulsory_measures_type === 'input'" 
                                    class="form-control" 
                                    placeholder="Silahkan Masukan Info Voluntary Measures">
                                <div v-show="risk.compulsory_measures_type === 'select' && risk.compulsory_measures === 'product to-be' ">
                                    <select 
                                        v-model="risk.add_compulsory_measures" 
                                        name="add_compulsory_measures" 
                                        :disabled="risk.compulsory_measures_type !== 'select' && risk.compulsory_measures !== 'product to-be' "
                                        class="form-control @error('add_compulsory_measures') {{ 'is-invalid' }} @enderror select2" >
                                        <option value="" disabled selected>- Silahkan Pilih Info Compulsory Measures -</option>
                                        @foreach ($a_product_to_be as $value)
                                        <option value="{{$value}}">{{ucfirst($value)}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                <div v-show="risk.compulsory_measures_type === 'select' && risk.compulsory_measures === 'physical treatment' ">
                                    <select 
                                        v-model="risk.add_compulsory_measures" 
                                        name="add_compulsory_measures" 
                                        :disabled="risk.compulsory_measures_type !== 'select' && risk.compulsory_measures !== 'physical treatment' "
                                        class="form-control @error('add_compulsory_measures') {{ 'is-invalid' }} @enderror select2">
                                        <option value="" disabled selected>- Silahkan Pilih Info Compulsory Measures -</option>
                                        @foreach ($a_physical_treatment as $value)
                                        <option value="{{$value}}">{{ucfirst($value)}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                @error('add_compulsory_measures')
                                    <small class="text-danger">{{ $errors->first('add_compulsory_measures') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($risk->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.risk_infos.destroy', $risk->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Info Resiko ini?</p>
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
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
@include('backadmin.risk_info.script')
@endpush