@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
@if($dangerous->id != null)
<li class="breadcrumb-item">
    <a 
    href="{{ 
        str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification' ?
        route('backadmin.downstreams.edit', $dangerous->notification->id) :
        route('backadmin.upstreams.edit', $dangerous->notification->id)
    
    }}"
    
    >{{ $dangerous->notification->number }}</a></li>
    @else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', request()->input('notification_id')) :
        route('backadmin.upstreams.edit', request()->input('notification_id'))
    
    }}"
    
    >{{ str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification' ? 'Downstream' : 'Upstream' }} Asal</a></li>
@endif
<li class="breadcrumb-item">Info Bahaya</li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $dangerous->id ? route('backadmin.dangerous_infos.update', $dangerous->id) : route('backadmin.dangerous_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($dangerous->id)
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
                    @if ($dangerous->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="name" class="form-label required">Jenis Bahaya yang Diidentifikasi</label>
                                <input
                                    autocomplete="disabled"
                                    type="text" 
                                    name="name"
                                    v-model="dangerous.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Jenis Bahaya" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="category_id" class="form-label required">Kategori Bahaya</small></label>
                                    <select
                                        id="category_id" 
                                        name="category_id" 
                                        v-model="dangerous.category_id" 
                                        class="form-control @error('category_id') {{ 'is-invalid' }} @enderror">
                                        {{-- <option value="" selected>- Silahkan Pilih Kategori Bahaya -</option>
                                        @foreach ($a_dangerous_category_id as $status)
                                        <option value="{{$status['value']}}">{{$status['label']}}</option>    
                                        @endforeach --}}
                        
                                    </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="name_result" class="form-label">Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
                                <input type="text" 
                                    autocomplete="disabled"
                                    name="name_result"
                                    v-model="dangerous.name_result" 
                                    class="form-control @error('name_result') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Jenis Bahaya" autocomplete="off">
                                @error('name_result')
                                    <small class="text-danger">{{ $errors->first('name_result') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="uom_result_id" class="form-label">Satuan Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
                                    <select
                                        id="uom_result_id" 
                                        name="uom_result_id" 
                                        v-model="dangerous.uom_result_id" 
                                        class="form-control @error('uom_result_id') {{ 'is-invalid' }} @enderror">
                                        {{-- <option value="" selected>- Silahkan Pilih Satuan Hasil Uji -</option>
                                        @foreach ($a_uom_result_id as $status)
                                        <option value="{{$status['value']}}">{{$status['label']}}</option>    
                                        @endforeach --}}
                        
                                    </select>
                                @error('uom_result_id')
                                    <small class="text-danger">{{ $errors->first('uom_result_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                        
                            <div class="col-12 col-md-12 form-group">
                                <label for="laboratorium" class="form-label ">Sampling</label>
                                <table id="table-sampling" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah Sampel</th>
                                            <th>Metode</th>
                                            <th>Tempat Pengambilan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- .col-md-6.form-group -->
                        
                        
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Analisis</div>
                            </div>
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="laboratorium" class="form-label ">Laboratorium</label>
                                <input type="text" 
                                    name="laboratorium"
                                    v-model="dangerous.laboratorium" 
                                    class="form-control @error('laboratorium') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Analisis Laboratorium" autocomplete="off">
                                @error('laboratorium')
                                    <small class="text-danger">{{ $errors->first('laboratorium') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="matrix" class="form-label ">Matriks</label>
                                <input type="text" 
                                    name="matrix"
                                    v-model="dangerous.matrix" 
                                    class="form-control @error('matrix') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Analisis Matriks" autocomplete="off">
                                @error('matrix')
                                    <small class="text-danger">{{ $errors->first('matrix') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Standar yang Berlaku</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">    
                                <label for="scope" class="form-label ">Scope</label>
                                <input type="text" 
                                    name="scope"
                                    v-model="dangerous.scope" 
                                    class="form-control @error('scope') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Analisis Laboratorium" autocomplete="off">
                                @error('scope')
                                    <small class="text-danger">{{ $errors->first('scope') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="max_tollerance" class="form-label ">Maksimum Batas yang Diijinkan</label>
                                <input type="text" 
                                    name="max_tollerance"
                                    v-model="dangerous.max_tollerance" 
                                    class="form-control @error('max_tollerance') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Analisis Matriks" autocomplete="off">
                                @error('max_tollerance')
                                    <small class="text-danger">{{ $errors->first('max_tollerance') }}</small>
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
    @if ($dangerous->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.dangerous_infos.destroy', $dangerous->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Info Bahaya ini?</p>
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
                dangerous: {},
                table_sampling : null,
                samplingModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: ''
                },
                validatorSampling : [
                    {
                        title: 'sampling_date',
                        name : 'sampling_date',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_qty',
                        name : 'sampling_qty',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_method',
                        name : 'sampling_method',
                        input: 'input',
                        required: true,
                        parse: null
                    },

                    {
                        title: 'sampling_place',
                        name : 'sampling_place',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                ],
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            dangerous = {!! json_encode($dangerous) !!};
            console.log(dangerous)
            this.dangerous = {
                name: old.name ?? dangerous.name ?? '',
                category_id: old.category_id ?? dangerous.category_id ?? '',
                name_result: old.name_result ?? dangerous.name_result ?? '',
                uom_result_id: old.uom_result_id ?? dangerous.uom_result_id ?? '',
                laboratorium: old.laboratorium ?? dangerous.laboratorium ?? '',
                matrix: old.matrix ?? dangerous.matrix ?? '',
                scope: old.scope ?? dangerous.scope ?? '',
                max_tollerance: old.max_tollerance ?? dangerous.max_tollerance ?? '',                
                
            }

            // console.log(this.dangerous)

            if(this.dangerous.category_id !== ''){
                initS2FieldWithAjax(
                    '#category_id',
                    '{{route("backadmin.s2Init.dangerous_category")}}',
                    {id:this.dangerous.category_id},
                    ['name']
                )
            }

            if(this.dangerous.uom_result_id !== ''){
                initS2FieldWithAjax(
                    '#uom_result_id',
                    '{{route("backadmin.s2Init.uom_result")}}',
                    {id:this.dangerous.uom_result_id},
                    ['name']
                )
            }

            
        },
        mounted() {
            $('.select2-dr').select2();

            this.table_sampling = $('#table-sampling').DataTable()

            this.initiateS2(
                "#category_id",
                "{{route('backadmin.s2Opt.dangerous_category')}}",
                0,
                "Silahkan Pilih Kategori Bahaya",
                ['name'],
                function(e){
                    form.dangerous.category_id = e.target.value
                }
            )

            this.initiateS2(
                "#uom_result_id",
                "{{route('backadmin.s2Opt.uom_result')}}",
                0,
                "Silahkan Pilih Satuan Hasil Uji",
                ['name'],
                function(e){
                    form.dangerous.uom_result_id = e.target.value
                }
            )
        },
        computed: {

        },
        methods: {
            initiateS2(
                elId,
                url,
                minimumInputLength = 3,
                placeholder = "Masukan Pilihan",
                attrs,
                onSelect
            ){
                return initiateS2(
                    elId,
                    url,
                    minimumInputLength,
                    placeholder,
                    attrs,
                    onSelect
                ) 
            }
        }
    }).mount('#app');
</script>
@endpush