@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.notifications.index') }}">Notifikasi</a></li>
@endsection

@section('actions')
    @if (!in_array($notification->status, ['processed']))
    <button type="submit" form="form-main" formaction="{{ $notification->id ? route('backadmin.notifications.update', $notification->id) : route('backadmin.notifications.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @endif
    @if ($notification->id)
        {{-- <a href="#" data-toggle="modal" data-target="#modal-process-downstream" class="btn btn-secondary"><i class="mr-75" data-feather="check"></i></a> --}}
        {{-- <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a> --}}
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
            </button>            
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">   
                @if (!in_array($notification->status, ['processed']))
                <a href="#" data-toggle="modal" data-target="#modal-process-downstream" class="dropdown-item"><i class="mr-75" data-feather="settings"></i>Downstream</a>
                <a href="#" class="dropdown-item"><i class="mr-75" data-feather="settings"></i>Upstream</a>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                @endif
                <a href="{{route('backadmin.notifications.index')}}" class="dropdown-item"><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
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
                    @csrf
                    @if ($notification->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                            <span class="badge badge-pill badge-light-{{ $notification->status_class }} px-2 py-50">{{ $notification->status_label }}</span>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="title" class="form-label required">Judul</label>
                                <input type="text" 
                                    name="title"
                                    v-model="notification.title" 
                                    class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Judul" autocomplete="off">
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="number" class="form-label required">Nomor</label>
                                <input type="text" 
                                    name="number"
                                    v-model="notification.number" 
                                    class="form-control @error('number') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Judul" autocomplete="off">
                                @error('number')
                                    <small class="text-danger">{{ $errors->first('number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="description" class="form-label required">Dekripsi</label>
                                <textarea
                                    id="summernote"
                                    type="text" 
                                    name="description"
                                    class="form-control @error('description') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Deskripsi" autocomplete="off">{{old()? old('description') : ($notification->description??'')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
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
    @if ($notification->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.notifications.destroy', $notification->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Notifikasi ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-process-downstream" tabindex="-1" role="dialog" aria-labelledby="modalProcessDownstream" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.notifications.process-downstream', $notification->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcess">Konfirmasi Proses Menjadi Downstream</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan membuat Notifikasi ini menjadi Notifikasi Downstream?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Proses Downstream</button>
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
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>


    let form = Vue.createApp({
        data() {
            return {
                notification: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            notification = {!! json_encode($notification) !!};
            console.log(notification)
            this.notification = {
                title: old.title ?? notification.title ?? '',     
                number: old.number ?? notification.number ?? '',                
            }

            console.log(this.notification)
        },
        mounted() {
            let summernote_config = {
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],                    
                ],
                height: 300
            };
            $('#summernote').summernote(summernote_config);

            @if (in_array($notification->status, ['processed']))
                $('.bi-form-main input, .bi-form-main select').prop('disabled', true);
                $('#summernote').summernote('disable');
            @endif
        },
        computed: {

        },
        methods: {
        }
    }).mount('#app');
</script>
@endpush