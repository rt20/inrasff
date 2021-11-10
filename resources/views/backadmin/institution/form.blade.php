@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.institutions.index') }}">Lembaga</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $institution->id ? route('backadmin.institutions.update', $institution->id) : route('backadmin.institutions.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($institution->id)
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    @endif
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($institution->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            <div class="col-12 form-group">
                                <div class="demo-spacing-0">
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading">Ketentuan Fitur Lembaga</h4>
                                        <div class="alert-body">
                                            <ul>
                                                <li><b>Nama Lembaga Harus Unik!</b> Sistem akan melakukan pengecekan untuk menghindari kesamaan nama lembaga</li>
                                                <li>Lembaga yang tidak memiliki Lembaga Terkait akan otomatis bertipe <b>CCP</b></li>
                                                <li>Lembaga yang memiliki Lembaga Terkait akan otomatis bertipe <b>LCCP</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="name" class="form-label required">Judul</label>
                                <input type="text" 
                                    name="name"
                                    v-model="institution.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="parent_id" class="form-label">Lembaga Terkait</label>
                                <div class="input-group">
                                    <select 
                                    class="form-control @error('parent_id') {{ 'is-invalid' }} @enderror" 
                                    id="f_parent_id"
                                    name="parent_id"
                                    v-model="institution.parent_id"
                                    ></select>
                                    <div class="input-group-append" style="width: 15% !important">
                                        <button v-on:click="clearParentId()" class="btn btn-primary w-100" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                </div>     
                                @error('parent_id')
                                    <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group" hidden>
                                <label for="type" class="form-label required">Tipe Institusi</label>
                                <input type="text" 
                                    name="type"
                                    readonly
                                    v-model="institution.type" 
                                    class="form-control @error('type') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan type" autocomplete="off">
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-6 form-group">
                                <label for="type" class="form-label required">Tipe Institusi</label>
                                <input type="text" 
                                    name="type_label"
                                    readonly
                                    v-model="institution.type_label" 
                                    class="form-control @error('type') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan type" autocomplete="off">
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
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
    @if ($institution->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.institutions.destroy', $institution->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Lembaga ini?</p>
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
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>


    let form = Vue.createApp({
        data() {
            return {
                institution: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            institution = {!! json_encode($institution) !!};
            console.log(institution)
            this.institution = {
                name: old.name ?? institution.name ?? '',
                type: old.type ?? institution.type ?? 'ccp',
                type_label: old.type_label ?? institution.type_label ?? 'Competent Contact Point',
                parent_id: old.parent_id ?? institution.parent_id ?? '',
                
            }

            if(this.institution.parent_id !== ''){
                initS2FieldWithAjax(
                    '#f_parent_id',
                    '{{route("backadmin.s2Init.institutions")}}',
                    {id:this.institution.parent_id},
                    ['type_label', 'name']
                )
            }
        },
        mounted() {      
            $('#f_parent_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.institutions') }}",
                    data: function(params){
                        let req = {
                            q:params.term,
                            only_ccp: true,
                        };
                        return req;
                    },
                    processResults: function(data){
                        return {results: data};
                    },
               },
               minimumInputLength:1,
               placeholder: 'Silahkan Pilih Lembaga Terkait',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.type_label + ' - ' +data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.type_label + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                // selected = e.params.data
                form.institution.parent_id = e.target.value
                form.setParentId()
                
            })
            .data('select2').$container.addClass("s2-w-85");
            $('.s2-w-85').attr('style', 'width:85% !important')
            
        },
        computed: {

        },
        methods: {
            clearParentId(){
                this.institution.type_label = "Competent Contact Point"
                this.institution.type = "ccp"
                $('#f_parent_id').val(null).trigger('change')
            },
            setParentId(){
                this.institution.type_label = "Local Competent Contact Point"
                this.institution.type = "lccp"
            }
        }
    }).mount('#app');
</script>
@endpush