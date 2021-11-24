@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.kementrian.index') }}">Kementrian</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $kementrian->id ? route('backadmin.kementrian.update', $kementrian->id) : route('backadmin.kementrian.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.kementrian.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($kementrian->id)
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
                    @if ($kementrian->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="title" class="form-label required">Nama</label>
                                <input type="text" 
                                    name="title"
                                    v-model="kementrian.title" 
                                    class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama" autocomplete="off">
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="excerpt" class="form-label required">Deskripsi</label>
                                <textarea
                                    type="text" 
                                    name="content"
                                    class="form-control @error('content') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Deskripsi" autocomplete="off" rows="7">{{old()? old('content') : ($kementrian->content??'')}}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $errors->first('content') }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="image" class="form-label required">Gambar</label>
                                <input 
                                    data-default-file="{{$kementrian->getImage()}}"
                                    type="file" 
                                    name="image"
                                    class="form-control @error('image') {{ 'is-invalid' }} @enderror dropify" 
                                    placeholder="Masukkan Gambar" autocomplete="off">
                                @error('image')
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="link" class="form-label">Website Link</label>
                                <input type="text" 
                                    name="link"
                                    v-model="kementrian.link" 
                                    class="form-control @error('link') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Website Link" autocomplete="off">
                                @error('link')
                                    <small class="text-danger">{{ $errors->first('link') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" 
                                    name="facebook"
                                    v-model="kementrian.facebook" 
                                    class="form-control @error('facebook') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Link Facebook" autocomplete="off">
                                @error('facebook')
                                    <small class="text-danger">{{ $errors->first('facebook') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" 
                                    name="instagram"
                                    v-model="kementrian.instagram" 
                                    class="form-control @error('instagram') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Link Instagram" autocomplete="off">
                                @error('instagram')
                                    <small class="text-danger">{{ $errors->first('instagram') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="instagram" class="form-label">Twitter</label>
                                <input type="text" 
                                    name="twitter"
                                    v-model="kementrian.twitter" 
                                    class="form-control @error('twitter') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Link Twitter" autocomplete="off">
                                @error('twitter')
                                    <small class="text-danger">{{ $errors->first('twitter') }}</small>
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
    @if ($kementrian->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.kementrian.destroy', $kementrian->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Kementrian ini?</p>
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
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>


    let form = Vue.createApp({
        data() {
            return {
                kementrian: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            kementrian = {!! json_encode($kementrian) !!};
            console.log(kementrian)
            this.kementrian = {
                title: old.title ?? kementrian.title ?? '',
                content: old.content ?? kementrian.content ?? '',
                link: old.link ?? kementrian.link ?? '',
                facebook: old.facebook ?? kementrian.facebook ?? '',
                twitter: old.twitter ?? kementrian.twitter ?? '',
                instagram: old.instagram ?? kementrian.instagram ?? '',
            }

            console.log(this.news)
        },
        mounted() {
            $('.dropify').dropify();
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