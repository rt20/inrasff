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
<li class="breadcrumb-item"><a href="{{ route('backadmin.issue_notifications.index') }}">Isu Notifikasi</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $issue_notification->id ? route('backadmin.issue_notifications.update', $issue_notification->id) : route('backadmin.issue_notifications.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    {{-- @if ($issue_notification->id) --}}
        <a href="#" class="btn btn-secondary" ><i class="mr-75" data-feather="settings"></i>Pengaturan</a>
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    {{-- @endif --}}
@endsection

@section('content')
{{-- <div class="card">
    <div class="card-body"> --}}
        <ul class="nav nav-tabs" id="myTab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Informasi Utama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="profile-tab-justified" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="true">Tindak Lanjut</a>
            </li>
        </ul>
        <!-- Vertical Wizard -->
        <div class="tab-content pt-1">
            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                @include('backadmin.issue_notification.main')
            </div>

            <div class="tab-pane " id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                @include('backadmin.issue_notification.follow_up')
            </div>

        </div>
        <!-- /Vertical Wizard -->
    {{-- </div>
</div> --}}
@endsection

@push('modal')
    @if ($issue_notification->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.issue_notifications.destroy', $issue_notification->id) }}" method="POST">
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
                issue_notification: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            issue_notification = {!! json_encode($issue_notification) !!};
            console.log(issue_notification)
            
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