@extends('backadmin.layouts.master')

@section('vendor-css')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.faq.index') }}">FAQ</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $faq->id ? route('backadmin.faq.update', $faq->id) : route('backadmin.faq.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.faq.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($faq->id)
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
                    @if ($faq->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="question" class="form-label required">Pertanyaan</label>
                                <input type="text" 
                                    name="question"
                                    v-model="faq.question" 
                                    class="form-control @error('question') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Pertanyaan" autocomplete="off">
                                @error('question')
                                    <small class="text-danger">{{ $errors->first('question') }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="excerpt" class="form-label required">Jawaban</label>
                                <textarea
                                    type="text" 
                                    name="answer"
                                    class="form-control @error('answer') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan answer" autocomplete="off">{{old()? old('answer') : ($faq->answer??'')}}</textarea>
                                @error('answer')
                                    <small class="text-danger">{{ $errors->first('answer') }}</small>
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
    @if ($faq->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.faq.destroy', $faq->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus FAQ ini?</p>
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
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>

    let form = Vue.createApp({
        data() {
            return {
                faq: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            faq = {!! json_encode($faq) !!};
            console.log(faq)
            this.faq = {
                question: old.question ?? faq.question ?? '',
                answer: old.answer ?? faq.answer ?? '',
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