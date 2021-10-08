@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/wizard/bs-stepper.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-validation.css') }}">    
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-wizard.css') }}">    
    <style>
        .read-only-white{
            background-color: #fff !important
        }
    </style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.downstreams.index') }}">Downstream</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $downstream->id ? route('backadmin.downstreams.update', $downstream->id) : route('backadmin.downstreams.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    {{-- @if ($downstream->id) --}}
        {{-- <a href="{{ route('backadmin.downstreams.setting', 0) }}" class="btn btn-secondary" ><i class="mr-75" data-feather="settings"></i>Pengaturan</a> --}}
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    {{-- @endif --}}
@endsection

@section('content')
{{-- <div class="card">
    <div class="card-body"> --}}
        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Informasi Utama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="profile-tab-justified" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="true">Tindak Lanjut</a>
                </li>
            </ul>
            <span class="badge badge-pill badge-light-{{ $downstream->status_class }} px-2 py-50">{{ $downstream->status_label }}</span>
        </div>
        <!-- Vertical Wizard -->
        <form method="post" id="form-main">
            @csrf
            @if ($downstream->id)
                @method('PUT')
            @endif
            <div class="tab-content pt-1">
                <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                    {{-- @include('backadmin.downstream.main') --}}
                    @include('backadmin.downstream.general')
                </div>

                <div class="tab-pane " id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                    @include('backadmin.downstream.follow_up')
                </div>

            </div>
        </form>
        <!-- /Vertical Wizard -->
    {{-- </div>
</div> --}}
@endsection

@push('modal')
    @if ($downstream->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.downstreams.destroy', $downstream->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Downstream ini?</p>
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
    @include('backadmin.layouts.script_datatables')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
@endsection

@push('page-js')
    {{-- <script src="{{ asset('backadmin/theme/js/scripts/forms/form-wizard.js') }}"></script> --}}
@include('backadmin.downstream.script')
@endpush