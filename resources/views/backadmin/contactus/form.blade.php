@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.contactus.index') }}">Hubungi Kami</a></li>
@endsection

@section('actions')
    {{-- <button type="submit" form="form-main" formaction="{{ route('backadmin.contactus.update', $contactus->id) }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button> --}}
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.contactus.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($contactus->id)
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($contactus->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" 
                                    name="name"
                                    v-model="contactus.name" readonly="" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" 
                                    name="email"
                                    v-model="contactus.email" readonly="" 
                                    class="form-control @error('email') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea
                                    type="text" 
                                    name="message" readonly="" 
                                    class="form-control @error('message') {{ 'is-invalid' }} @enderror" 
                                    placeholder="" autocomplete="off">{{old()? old('message') : ($contactus->message??'')}}</textarea>
                                @error('message')
                                    <small class="text-danger">{{ $errors->first('message') }}</small>
                                @enderror
                            </div>

                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($contactus->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.categories.destroy', $contactus->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Pesan ini?</p>
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
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>

    let form = Vue.createApp({
        data() {
            return {
                contactus: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            contactus = {!! json_encode($contactus) !!};
            console.log(contactus)
            this.contactus = {
                name: old.name ?? contactus.name ?? '',
                email: old.email ?? contactus.email ?? '',
                message: old.message ?? contactus.message ?? '',
            }

            console.log(this.contactus)
        },
        mounted() {
            //
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