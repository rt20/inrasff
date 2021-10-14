@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
@if($border_control->id != null)
<li class="breadcrumb-item">
    <a 
    href="{{ 
        str_replace('App\\Models\\', '', $border_control->bci_type) === 'DownStreamNotification' ?
        route('backadmin.downstreams.edit', $border_control->notification->id) :
        route('backadmin.upstreams.edit', $border_control->notification->id)
    
    }}"
    
    >{{ $border_control->notification->number }}</a></li>
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
<li class="breadcrumb-item">Kontrol Perbatasan</li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $border_control->id ? route('backadmin.border_control_infos.update', $border_control->id) : route('backadmin.border_control_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($border_control->id)
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
                    @if ($border_control->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="start_point" class="form-label required">Titik Keberangkatan</label>
                                <input type="text" 
                                    name="start_point"
                                    v-model="border_control.start_point" 
                                    class="form-control @error('start_point') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Titik Keberangkatan" autocomplete="off">
                                @error('start_point')
                                    <small class="text-danger">{{ $errors->first('start_point') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="entry_point" class="form-label required">Titik Masuk</label>
                                <input type="text" 
                                    name="entry_point"
                                    v-model="border_control.entry_point" 
                                    class="form-control @error('entry_point') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Titik Masuk" autocomplete="off">
                                @error('entry_point')
                                    <small class="text-danger">{{ $errors->first('entry_point') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="supervision_point" class="form-label required">Titik Pengawasan</label>
                                <input type="text" 
                                    name="supervision_point"
                                    v-model="border_control.supervision_point" 
                                    class="form-control @error('supervision_point') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Titik Pengawasan" autocomplete="off">
                                @error('supervision_point')
                                    <small class="text-danger">{{ $errors->first('supervision_point') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="destination_country_id" class="form-label required">Negara Tujuan</label>
                                <select 
                                    id="destination_country_id"
                                    name="destination_country_id"
                                    v-model="border_control.destination_country_id" 
                                    class="form-control @error('destination_country_id') {{ 'is-invalid' }} @enderror" 
                                     autocomplete="off">
                                </select>
                                @error('destination_country_id')
                                    <small class="text-danger">{{ $errors->first('destination_country_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Consignee / Penerima</div>
                            </div>
                            <div class="col-12 col-md-12 form-group">
                                <label for="consignee_name" class="form-label ">Nama</label>
                                <input type="text" 
                                    name="consignee_name"
                                    v-model="border_control.consignee_name" 
                                    class="form-control @error('consignee_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama Penerima" autocomplete="off">
                                @error('consignee_name')
                                    <small class="text-danger">{{ $errors->first('consignee_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="consignee_address" class="form-label ">Alamat</label>
                                <textarea 
                                    class="form-control @error('consignee_address') {{ 'is-invalid' }} @enderror"
                                    name="consignee_address" 
                                    v-model="border_control.consignee_address" 
                                    placeholder="Masukkan Alamat Penerima" autocomplete="off"></textarea>
                                @error('consignee_address')
                                    <small class="text-danger">{{ $errors->first('consignee_address') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="container_number" class="form-label ">Container no (s) / Seal no (s)</label>
                                <input type="text" 
                                    name="container_number"
                                    v-model="border_control.container_number" 
                                    class="form-control @error('container_number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Container no (s) / Seal no (s)" autocomplete="off">
                                @error('container_number')
                                    <small class="text-danger">{{ $errors->first('container_number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Alat Transportasi</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="transport_name" class="form-label ">Nama</label>
                                <input type="text" 
                                    name="transport_name"
                                    v-model="border_control.transport_name" 
                                    class="form-control @error('transport_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama Transportasi" autocomplete="off">
                                @error('transport_name')
                                    <small class="text-danger">{{ $errors->first('transport_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="transport_description" class="form-label ">Keterangan</label>
                                <input type="text" 
                                    name="transport_description"
                                    v-model="border_control.transport_description" 
                                    class="form-control @error('transport_description') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Keterangan Transportasi" autocomplete="off">
                                @error('transport_description')
                                    <small class="text-danger">{{ $errors->first('transport_description') }}</small>
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
    @if ($border_control->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.border_control_infos.destroy', $border_control->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Kontrol Perbatasan ini?</p>
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
<script>


    let form = Vue.createApp({
        data() {
            return {
                border_control: {},
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            console.log(old)
            border_control = {!! json_encode($border_control) !!};
            console.log(border_control)
            this.border_control = {
                start_point: old.start_point ?? border_control.start_point ?? '',
                entry_point: old.entry_point ?? border_control.entry_point ?? '',
                supervision_point: old.supervision_point ?? border_control.supervision_point ?? ''  ,             
                destination_country_id: old.destination_country_id ?? border_control.destination_country_id ?? ''               ,
                consignee_name: old.consignee_name ?? border_control.consignee_name ?? ''    ,           
                consignee_address: old.consignee_address ?? border_control.consignee_address ?? ''        ,       
                container_number: old.container_number ?? border_control.container_number ?? ''      ,         
                transport_name: old.transport_name ?? border_control.transport_name ?? ''             ,  
                transport_description: old.transport_description ?? border_control.transport_description ?? '',                
            }

            if(this.border_control.destination_country_id !== ''){
                initS2FieldWithAjax(
                    '#destination_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.border_control.destination_country_id},
                    ['code', 'name']
                )
            }

            console.log(this.border_control)
        },
        mounted() {
            // $('.select2-dr').select2();
            $('#destination_country_id').select2({
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
               placeholder: 'Masukkan Negara Tujuan',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.border_control.destination_country_id = e.target.value
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
@endpush