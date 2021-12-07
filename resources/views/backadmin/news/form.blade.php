@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<style type="text/css">
    .read-only-white {
        background-color: #FFF !important;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.news.index') }}">Berita</a></li>
@endsection

@section('actions')
    @if($news->id)
        @if(in_array(Auth::user()->type, ['ncp', 'superadmin']) || $news->author_id == Auth::user()->id)
    <button type="submit" form="form-main" formaction="{{ $news->id ? route('backadmin.news.update', $news->id) : route('backadmin.news.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @endif
    @else
        <button type="submit" form="form-main" formaction="{{ $news->id ? route('backadmin.news.update', $news->id) : route('backadmin.news.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @endif
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.news.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($news->id)
                @if(in_array(Auth::user()->type, ['ncp', 'superadmin']) || $news->author_id == Auth::user()->id)
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                @endif
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
                    @if ($news->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="title" class="form-label required">Judul</label>
                                <input type="text" 
                                    name="title"
                                    v-model="news.title" 
                                    class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="slug" class="form-label required">Slug</label>
                                <input type="text" 
                                    name="slug"
                                    v-model="news.slug" 
                                    class="form-control @error('slug') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan slug" autocomplete="off">
                                @error('slug')
                                    <small class="text-danger">{{ $errors->first('slug') }}</small>
                                @enderror
                            </div>
                            
                            @if(in_array(Auth::user()->type, ['ncp', 'superadmin']))
                            <div class="col-12 col-md-4 form-group">
                                <label for="status" class="form-label required">Status</label>
                                <select name="status" class="form-control @error('status') {{ 'is-invalid' }} @enderror"
                                    placeholder="Pilih Status" autocomplete="off">
                                    <option value='draft' {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value='published' {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value='rejected' {{ $news->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            @endif

                            <div class="col-12 @if(in_array(Auth::user()->type, ['ncp', 'superadmin'])) col-md-4 @else col-md-6 @endif form-group">
                                <label for="published_at" class="form-label required">Tanggal Publish</label>
                                <input type="text" 
                                    name="published_at"
                                    v-model="news.published_at" 
                                    class="form-control date read-only-white @error('published_at') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Tanggal Publish" autocomplete="off">
                                @error('published_at')
                                    <small class="text-danger">{{ $errors->first('published_at') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 @if(in_array(Auth::user()->type, ['ncp', 'superadmin'])) col-md-4 @else col-md-6 @endif form-group">
                                <label for="category_id" class="form-label required">Kategori Berita</label>
                                <select name="category_id" 
                                    v-model="news.category_id" 
                                    id="f_category_id" 
                                    class="form-control @error('category_id') {{ 'is-invalid' }} @enderror">
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="image" class="form-label required">Gambar</label>
                                <input 
                                    data-default-file="{{$news->getImage()}}"
                                    type="file" 
                                    name="image"
                                    class="form-control @error('image') {{ 'is-invalid' }} @enderror dropify" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('image')
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="excerpt" class="form-label required">Excerpt</label>
                                <textarea
                                    type="text" 
                                    name="excerpt"
                                    class="form-control @error('excerpt') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Excerpt" autocomplete="off">{{old()? old('excerpt') : ($news->excerpt??'')}}</textarea>
                                @error('excerpt')
                                    <small class="text-danger">{{ $errors->first('excerpt') }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="content" class="form-label required">Dekripsi</label>
                                <textarea
                                    id="summernote"
                                    type="text" 
                                    name="content"
                                    class="form-control @error('content') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Deskripsi" autocomplete="off">{{old()? old('content') : ($news->content??'')}}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $errors->first('content') }}</small>
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
    @if ($news->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.news.destroy', $news->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Berita ini?</p>
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
                news: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            news = {!! json_encode($news) !!};
            console.log(news)
            this.news = {
                title: old.title ?? news.title ?? '',
                slug: old.slug ?? news.slug ?? '',
                category_id: old.category_id ?? news.category_id ?? '',
                content: old.content ?? news.content ?? '',
                published_at: old.published_at ?? news.published_at ?? '',
                status: old.status ?? news.status ?? '',
                excerpt: old.excerpt ?? news.excerpt ?? '',
            }

            if(this.news.category_id !== ''){
                initS2FieldWithAjax(
                    '#f_category_id',
                    '{{route("backadmin.s2Init.category_news")}}',
                    {id:this.news.category_id},
                    ['name']
                )
            }

            console.log(this.news)
        },
        mounted() {
            $('.date').flatpickr();
            $('.dropify').dropify();
            $('input[name="title"]').keyup(function(event) {
                // $('input[name="slug"]').val(form.slugify($(this).val()));
                form.news.slug = form.slugify($(this).val())
            });
            

            var lfm = function (options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
            // Define LFM summernote button
            var LFMButton = function (context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Insert image with filemanager',
                    click: function () {

                        lfm({
                            type: 'image',
                            prefix: '{{route("unisharp.lfm.show")}}'
                        }, function (lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };
            let summernote_config = {
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    // ['popovers', ['lfm']],
                ],
                buttons: {
                    lfm: LFMButton,
                },
                height: 300
            };
            $('#summernote').summernote(summernote_config);

            $('#f_category_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.category_news') }}",
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
               placeholder: 'Silahkan Pilih Kategori',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.name;
                }

            }).on('select2:select', function(e){
                // selected = e.params.data
                form.news.category_id = e.target.value
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