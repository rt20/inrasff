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
    @can('store traceability')
        @if(!$traceability_lot->id)
        <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @elseif(in_array($traceability_lot->notification->status, ['open', 'draft']))
        <button type="submit" form="form-main" formaction="{{ $traceability_lot->id ? route('backadmin.traceability_lot_infos.update', $traceability_lot->id) : route('backadmin.traceability_lot_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @endif
    @endcan
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
            @can('delete traceability')
            @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
            @endif
            @endcan                
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
                                    placeholder="Masukkan Best Before" autocomplete="off">
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
                                    placeholder="Masukkan Sell By" autocomplete="off">
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
                            
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
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
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
@endsection

@push('page-js')
<script>


    let form = Vue.createApp({
        data() {
            return {
                traceability_lot: {},
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            console.log(old)
            traceability_lot = {!! json_encode($traceability_lot) !!};
            console.log(traceability_lot)
            this.traceability_lot = {
                source_country_id: old.source_country_id ?? traceability_lot.source_country_id ?? '',
                number: old.number ?? traceability_lot.number ?? '',
                used_by: old.used_by ?? traceability_lot.used_by ?? '',
                best_before: old.best_before ?? traceability_lot.best_before ?? ''  ,             
                sell_by: old.sell_by ?? traceability_lot.sell_by ?? ''               ,
                number_unit: old.number_unit ?? traceability_lot.number_unit ?? ''    ,           
                net_weight: old.net_weight ?? traceability_lot.net_weight ?? ''        ,       
                cert_number: old.cert_number ?? traceability_lot.cert_number ?? ''      ,         
                cert_date: old.cert_date ?? traceability_lot.cert_date ?? ''             ,  
                cert_institution: old.cert_institution ?? traceability_lot.cert_institution ?? '',               
                add_cert_number: old.add_cert_number ?? traceability_lot.add_cert_number ?? ''    ,           
                add_cert_date: old.add_cert_date ?? traceability_lot.add_cert_date ?? ''           ,    
                add_cert_institution: old.add_cert_institution ?? traceability_lot.add_cert_institution ?? '' ,              

                
            }

            if(this.traceability_lot.source_country_id !== ''){
                initS2FieldWithAjax(
                    '#source_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.traceability_lot.source_country_id},
                    ['code', 'name']
                )
            }

            console.log(this.traceability_lot)
        },
        mounted() {
            $('.date').flatpickr();
            $('#source_country_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.countries') }}",
                    data: function(params){
                        let req = {
                            q:params.term,
                        };
                        return req;
                    },
                    processResults: function(data){
                        return {results: data};
                    },
               },
               minimumInputLength:1,
               placeholder: 'Masukkan Negara Asal',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.traceability_lot.source_country_id = e.target.value
            })
        },
        computed: {

        },
        methods: {
            slugify(text){
                return slugify(text)
            }
        }
    }).mount('#app');
</script>
<script>
    $(document).ready(function(){
        console.log('ready log section form')
        @if(!in_array($traceability_lot->notification->status, ['open', 'draft']))
            $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
            $('.bi-form-main input').removeClass('read-only-white')
            $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
        @endif
    })
</script>
@endpush