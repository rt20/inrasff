@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.issue_notifications.create') }}">Isu Pangan A</a></li>
@endsection

@section('actions')
<a href="{{ route('backadmin.issue_notifications.create') }}" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @if ($issue_notification->id)
                        @method('PUT')
                    @endif --}}
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Pengaturan Lembaga Pemangku</h4>
                        </div>
    
                        <div class="row">                            
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="setting">List Lembaga Pemangku</label>
                                    <button href="#"  class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                </div>
                                
                                <table id="table-setting" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Unit</th>
                                            <th>Level</th>
                                            <th>Nama Lembaga</th>
                                            <th>Tanggal Ditambahkan</th>
                                            <th class="pr-table-col-action-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Unit Utama</td>
                                            <td>CCP</td>
                                            <td>Kementrian Kesehatan</td>
                                            <td>19 Agustus 2021</td>
                                            <td class=" text-center">
                                                <button class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unit Kerja 10</td>
                                            <td>LCCP</td>
                                            <td>Kementrian Kesehatan</td>
                                            <td>21 Agustus 2021</td>
                                            <td class=" text-center">
                                                <button class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unit Utama</td>
                                            <td>CCP</td>
                                            <td>BPOM</td>
                                            <td>19 Agustus 2021</td>
                                            <td class=" text-center">
                                                <button class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                issue_notification: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            
        },
        mounted() {
            $('.dropify').dropify();
            $('#table-setting').DataTable()
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