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
<li class="breadcrumb-item"><a href="{{ route('backadmin.upstreams.index') }}">Upstream</a></li>
@endsection

@section('actions')
    @if (!in_array($upstream->status, ['ext process', 'done']))
        @can('store upstream')

        @if($upstream->id)
            @if($upstream->author_id == auth()->user()->id)
            <button type="submit" form="form-main" formaction="{{ $upstream->id ? route('backadmin.upstreams.update', $upstream->id) : route('backadmin.upstreams.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
            @endif
        @else
        <button type="submit" form="form-main" formaction="{{ $upstream->id ? route('backadmin.upstreams.update', $upstream->id) : route('backadmin.upstreams.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
        @endif
        @endcan
    @endif
    @if ($upstream->id)
        @if (in_array($upstream->status, ['open']))
            @can('finish upstream')
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-done"><i class="mr-75" data-feather="settings"></i>Selesaikan</a>
            @endcan
        @endif
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
            </button>    
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
                <a href="{{route('backadmin.upstreams.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
                <a href="{{route('test_report')}}" class="dropdown-item" ><i class="mr-75" data-feather="printer"></i>Dokumen</a>
                @if (!in_array($upstream->status, ['done']))
                    @can('delete upstream')
                    @if($upstream->author_id == auth()->user()->id)
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                    @endif
                    @endcan
                @endif
            </div>
        </div>
    @endif
@endsection

@section('content')
{{-- <div class="card">
    <div class="card-body"> --}}
        <div class="d-flex justify-content-between align-items-end pb-1">
            <h1></h1>
            <span class="badge badge-pill badge-light-{{ $upstream->status_class }} px-2 py-50">{{ $upstream->status_label }}</span>
        </div>
        <div class="nav-vertical">
            
            <ul class="nav nav-tabs nav-left flex-column" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  {{ $focus==null? 'active' : '' }}" id="home-tab-justified" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">1. Informasi Umum</a>
                </li>
                
                @if($upstream->id != null && !$upstream->isStatus('draft', false))
                <li class="nav-item">
                    <a class="nav-link " id="institution-tab-justified" data-toggle="tab" href="#institution" role="tab" aria-controls="institution" aria-selected="true">2. Info Penindak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $focus=== 'dangerous_risks' ? 'active' : '' }}" id="dangerous-risk-tab-justified" data-toggle="tab" href="#dangerous-risk" role="tab" aria-controls="dangerous-risk" aria-selected="true">3. Bahaya & Resiko</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $focus=== 'traceability_lots' ? 'active' : '' }}" id="dangerous-traceability-lot-tab-justified" data-toggle="tab" href="#traceability-lot" role="tab" aria-controls="traceability-lot" aria-selected="true">4. Keterlusuran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $focus=== 'border_controls' ? 'active' : '' }}" id="border-control-tab-justified" data-toggle="tab" href="#border-control" role="tab" aria-controls="border-control" aria-selected="true">5. Kontrol Perbatasan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="additional-tab-justified" data-toggle="tab" href="#additional" role="tab" aria-controls="additional" aria-selected="true">6. Informasi Tambahan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="attachment-tab-justified" data-toggle="tab" href="#attachment" role="tab" aria-controls="border-control" aria-selected="true">7. Lampiran</a>
                    
                </li>
                
                    @if($upstream->isStatus('open', false))
                    <li class="nav-item">
                        <a class="nav-link " id="follow-up-tab-justified" data-toggle="tab" href="#follow-up" role="tab" aria-controls="border-control" aria-selected="true">8. Tindak Lanjut</a>
                    </li>
                    @endif
                @endif
            </ul>
            
            <!-- Vertical Wizard -->
            <form method="post" id="form-main"> 
                {{-- <input hidden readonly name="section_form" id="section-form" value="general"> --}}
                @csrf
                @if ($upstream->id)
                    @method('PUT')
                @endif
                <div class="tab-content">
                    <div class="tab-pane {{ $focus== null ? 'active' : '' }}" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.general')
                    </div>

                    @if($upstream->id != null)
                    
                    <div class="tab-pane " id="institution" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.institution')
                    </div>
                    <div class="tab-pane {{ $focus=== 'dangerous_risks' ? 'active' : '' }}" id="dangerous-risk" role="tabpanel" aria-labelledby="home-tab-justified">
                        {{-- @include('backadmin.upstream.dangerous_risk') --}}
                        @include('backadmin.upstream.tab.dangerous_risks')
                    </div>
                    <div class="tab-pane {{ $focus=== 'traceability_lots' ? 'active' : '' }}" id="traceability-lot" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.traceability_lots')
                    </div>
                    <div class="tab-pane {{ $focus=== 'border_controls' ? 'active' : '' }}" id="border-control" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.border_controls')
                    </div>
                    <div class="tab-pane " id="additional" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.additional')
                    </div>
                    <div class="tab-pane " id="attachment" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.attachment')
                    </div>
                    @if($upstream->isStatus('open', false))
                    <div class="tab-pane " id="follow-up" role="tabpanel" aria-labelledby="home-tab-justified">
                        @include('backadmin.upstream.tab.follow_ups')
                    </div>
                    @endif
                    @endif

                    {{-- <div class="tab-pane " id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                        @include('backadmin.upstream.follow_up')
                    </div> --}}

                </div>
            </form>
        </div>
        <!-- /Vertical Wizard -->
    {{-- </div>
</div> --}}
@endsection

@push('modal')
    @if ($upstream->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.upstreams.destroy', $upstream->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Upstream ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-process-ext" tabindex="-1" role="dialog" aria-labelledby="modalProcessCcp" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.upstreams.process-ext', $upstream->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcessCcp">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan memproses Upstream ini untuk Eksternal?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Proses</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-back-open" tabindex="-1" role="dialog" aria-labelledby="modalBackOpen" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.upstreams.back-open', $upstream->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcessCcp">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan mengembalikan Upstream ini untuk dibuka?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Proses</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-done" tabindex="-1" role="dialog" aria-labelledby="modalProcessCcp" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.upstreams.done', $upstream->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcessCcp">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menyelesaikan Upstream ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Proses</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
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
@include('backadmin.upstream.script')
{{-- @include('backadmin.upstream.script_dangerous_risk') --}}

<script>
    $(document).ready(function(){
        console.log('ready log section form')
        @if (in_array($upstream->status, ['done']))
            $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
            $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
        @elseif($upstream->id)
            @if($upstream->author_id != auth()->user()->id)
                $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
                $('.read-only-white').removeClass('read-only-white')
                $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
            @endif
        @endif
    })
</script>

@endpush