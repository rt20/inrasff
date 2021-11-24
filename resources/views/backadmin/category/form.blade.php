@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.categories.index') }}">Kategori</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $category->id ? route('backadmin.categories.update', $category->id) : route('backadmin.categories.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.categories.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($category->id)
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
                    @if ($category->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" 
                                    name="name"
                                    v-model="category.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="excerpt" class="form-label required">Deskripsi</label>
                                <textarea
                                    type="text" 
                                    name="description"
                                    class="form-control @error('description') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan description" autocomplete="off">{{old()? old('description') : ($category->description??'')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
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
    @if ($category->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Kategori ini?</p>
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
                category: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            category = {!! json_encode($category) !!};
            console.log(category)
            this.category = {
                name: old.name ?? category.name ?? '',
                description: old.description ?? category.description ?? '',
            }

            console.log(this.category)
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