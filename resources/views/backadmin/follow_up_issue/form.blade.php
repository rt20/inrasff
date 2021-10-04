@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/wizard/bs-stepper.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-validation.css') }}">    
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-wizard.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.follow_up_issues.index') }}">Tindak Lanjut</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $follow_up_issue->id ? route('backadmin.follow_up_issues.update', $follow_up_issue->id) : route('backadmin.follow_up_issues.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    {{-- @if ($follow_up_issue->id) --}}
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    {{-- @endif --}}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @if ($news->id) --}}
                        {{-- @method('PUT') --}}
                    {{-- @endif --}}
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control"  value="Tindak Lanjut 1"/>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Tanggal Diproses</label>
                                <input type="text" class="form-control"  value="22 Agustus 2021"/>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control"  value="Kementrian Kelautan"/>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Penulis Laporan</label>
                                <input type="text" class="form-control"  value="Kementrian Kelautan"/>
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea style="height: 200px" class="form-control" >Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy bear claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé. Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie cheesecake liquorice apple pie.</textarea>
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <div class="d-flex  align-items-center mb-1">
                                    <label class="form-label mr-50">Lampiran</label>
                                    <button type="button" class="btn btn-icon btn-primary" id="btn-plus"><i class="" data-feather="plus"></i></button>
                                </div>
                                
                                <div class="demo-spacing-0">
                                    <a href="#" target="_blank">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                                <i class="mr-75" data-feather="file"></i>
                                                <strong>Lampiran_Penindak_Lanjutan_1.pdf</strong>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="demo-spacing-0 mt-50">
                                    <a href="#" target="_blank">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                                <i class="mr-75" data-feather="file"></i>
                                                <strong>Lampiran_Penindak_Lanjutan_2.pdf</strong>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </section><!-- .bi-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($follow_up_issue->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.follow_up_issues.destroy', $follow_up_issue->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Isu Notifikasi ini?</p>
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
    {{-- <script src="../../../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script> --}}
    <script src="{{ asset('backadmin/theme/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
@endsection

@push('page-js')
    <script src="{{ asset('backadmin/theme/js/scripts/forms/form-wizard.js') }}"></script>
    
<script>


    let form = Vue.createApp({
        data() {
            return {
                follow_up_issue: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            follow_up_issue = {!! json_encode($follow_up_issue) !!};
            console.log(follow_up_issue)
            
        },
        mounted() {
            
        },
        computed: {

        },
        methods: {
            
        }
    }).mount('#app');
</script>
@endpush