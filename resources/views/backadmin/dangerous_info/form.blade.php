@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<style>
    .read-only-white{
        background-color: #fff !important
    }
</style>
@endsection

@section('breadcrumb')
@if($dangerous->id != null)
    <li class="breadcrumb-item">
        <a 
        href="{{ 
            str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification' ?
            route('backadmin.downstreams.edit', ['downstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks']) :
            route('backadmin.upstreams.edit', ['upstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks'])
        
        }}"
        
        >{{ $dangerous->notification->number }}</a></li>
@else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', ['downstream' => request()->input('notification_id'), 'focus' => 'dangerous_risks']) :
        route('backadmin.upstreams.edit', ['upstream' => request()->input('notification_id'), 'focus' => 'dangerous_risks'])
    
    }}"
    
    >{{ request()->input('notification_type') === 'downstream' ? 'Downstream' : 'Upstream' }} Asal</a></li>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="laboratorium" class="form-label ">Sampling</label>
                                    <button type="button" v-on:click="openSamplingModal('add', null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                </div>
                                <table v-cloak id="table-sampling" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah Sampel</th>
                                            <th>Metode</th>
                                            <th>Tempat Pengambilan</th>
                                            <th class="bi-table-col-action-1">Aksi</th>
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
                <div class="modal fade" id="sampling-modal" tabindex="-1" role="dialog" aria-labelledby="modalAddsampling" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="sampling-modal-form" action="#" method="GET">                    
                                <div class="modal-header">
                                    <h4 v-show="samplingModal.state !== 'delete'" class="modal-title" id="modalAddsampling">Tambah Instansi</h4>
                                    <h4 v-show="samplingModal.state === 'delete'" class="modal-title" id="modalAddsampling">Hapus Instansi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" v-show="samplingModal.state !== 'delete'">
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label required">Tanggal Sampling</label>
                                            <input placeholder="Masukan Tanggal Sampling" id="sampling_date" name="sampling_date" class="form-control date read-only-white" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label required">Jumlah Sampling</label>
                                            <input placeholder="Masukan Jumlah Sampling" id="sampling_count" name="sampling_count" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label">Metode Sampling</label>
                                            <input placeholder="Masukan Metode Sampling" id="sampling_method" name="sampling_method" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label">Tempat Pengambilan Sampling</label>
                                            <input placeholder="Masukan Tempat Pengambilan Sampling" id="sampling_place" name="sampling_place" class="form-control" autocomplete="off"/>
                                        </div>
                                    </div>
                
                                    <div v-show="samplingModal.state === 'delete'">
                                        <p class="mb-0">Apakah Anda yakin akan menghapus Instansi ini?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                    <button v-if="samplingModal.state !== 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Tambahkan</button>
                                    <button v-if="samplingModal.state === 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Ya, Hapus</button>
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
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
@endsection

@push('page-js')
<script>
    function openSamplingModal(state, id=null, item = {id:null}){
        
        form.openSamplingModal(state, id, item)        
    }

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
                        title: 'sampling_count',
                        name : 'sampling_count',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_method',
                        name : 'sampling_method',
                        input: 'input',
                        required: false,
                        parse: null
                    },

                    {
                        title: 'sampling_place',
                        name : 'sampling_place',
                        input: 'input',
                        required: false,
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
            // $('.select2-dr').select2();
            $('.date').flatpickr();

            let icon = feather.icons['trash'].toSvg();
            this.table_sampling = $('#table-sampling').DataTable({
                ajax:{
                    url:"{{route('backadmin.dangerous_samplings.index')}}",
                    data: function(data) {
                        data.di_id = '{{$dangerous->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { 
                        data: 'sampling_date' ,
                        render: function(data, type, row, meta){
                            return moment(data).format('D MMMM YYYY')
                        }
                    },
                    { data: 'sampling_count' },
                    { 
                        data: 'sampling_method',
                        defaultContent: '-' 
                    },
                    { 
                        data: 'sampling_place',
                        defaultContent: '-'
                    },
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openSamplingModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

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
            },
            openSamplingModal(state, id=null, item = {id:null}){
                console.log("Halo")

                $('#sampling-modal-form').trigger('reset')
                
                $('.text-warn').remove();
                this.samplingModal.state = state;
                switch (this.samplingModal.state) {
                    case 'add':                    
                        this.samplingModal.item = item;                        
                        break;
                    case 'delete':
                        // this.samplingModal.item = Object.assign({}, this.slider.slider_image[index]);
                        this.samplingModal.item = {id:id};   
                        break;
                    
                    default:
                        break;
                }
                $('#sampling-modal').modal({ backdrop: 'static', keyboard: false })
            },
            async submitItem(e){
                e.preventDefault()
                $('.text-warn').remove();
                let invalid;

                switch (this.samplingModal.state) {
                    case 'add':
                        this.validatorSampling.forEach(el => {
                            if(el.required==true)
                            {
                                if(!$(el.input+'[name="'+el.title+'"]').val() ){
                                    $(el.input+'[name="'+el.title+'"]').parent().append(`
                                        <small class="text-danger text-warn">Field ini harus diisi</small>
                                    `);
                                    invalid = true;
                                }
                            }
                        });

                        if(invalid)
                            return;

                        var url = `{{ route('backadmin.dangerous_samplings.add') }}`
                        var formData = new FormData()
                        this.validatorSampling.forEach(el => {
                            var value = $(el.input+'[name="'+el.title+'"]').val()
                            console.log(value)
                            formData.append(el.name, value)
                        });
                        formData.append('di_id', {{$dangerous->id}})
                        
                        var resp = await post(url,formData)
                        console.log(resp)
                            if(resp?.data?.status?.localeCompare('ok')==0){
                                $('#sampling-modal').modal('hide')
                                    this.table_sampling.ajax.reload()
                                

                            }else{
                                alert(resp?.data?.message)
                            }    
                        
                        break;
                
                    case 'delete': 
                        var url = `{{ route('backadmin.dangerous_samplings.delete', '__id') }}`
                        url = url.replace("__id", this.samplingModal?.item?.id)
                        var resp = await destroy(url)
                        console.log(resp)
                        if(resp?.data?.status?.localeCompare('ok')==0){
                            $('#sampling-modal').modal('hide')
                                this.table_sampling.ajax.reload()

                        }else{
                            alert(resp?.data?.message)
                        }   
                        break;
                    
                    default:
                        break;
                }
                
            },
        }
    }).mount('#app');
</script>
@endpush