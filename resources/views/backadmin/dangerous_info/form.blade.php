@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<style>
    .read-only-white{
        background-color: #fff !important
    }
</style>
@endsection

@section('breadcrumb')
@if($dangerous->id != null)
    <li class="breadcrumb-item">
        <a 
        href="{{ 
            str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification' ?
            route('backadmin.downstreams.edit', ['downstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks']) :
            route('backadmin.upstreams.edit', ['upstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks'])
        
        }}"
        
        >{{ $dangerous->notification->number }}</a></li>
@else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', ['downstream' => request()->input('notification_id'), 'focus' => 'dangerous_risks']) :
        route('backadmin.upstreams.edit', ['upstream' => request()->input('notification_id'), 'focus' => 'dangerous_risks'])
    
    }}"
    
    >{{ request()->input('notification_type') === 'downstream' ? 'Downstream' : 'Upstream' }} Asal</a></li>
@endif
<li class="breadcrumb-item">Info Bahaya</li>
@endsection

@section('actions')
    {{-- For Update --}}
    @if($dangerous->id != null)
        {{-- If Dangerous Info for Downstream --}}
        @if(str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification')
            @can('store d_dangerous')
                @if(in_array($dangerous->notification->status, ['open', 'draft']))
                <button type="submit" form="form-main" formaction="{{ $dangerous->id ? route('backadmin.dangerous_infos.update', $dangerous->id) : route('backadmin.dangerous_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
                @endif
            @endcan
        {{-- If Dangerous Info for Upstream --}}
        @else
            @can('store u_dangerous')
                @if(in_array($dangerous->notification->status, ['open', 'draft']))
                <button type="submit" form="form-main" formaction="{{ $dangerous->id ? route('backadmin.dangerous_infos.update', $dangerous->id) : route('backadmin.dangerous_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
                @endif
            @endcan
        @endif

    {{-- For New Data --}}
    @else
        {{-- If Dangerous Info for Downstream --}}
        @if(request()->input('notification_type') === 'downstream')
            @can('store d_dangerous')
            <button type="submit" form="form-main" formaction="{{ $dangerous->id ? route('backadmin.dangerous_infos.update', $dangerous->id) : route('backadmin.dangerous_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
            @endcan
        {{-- If Dangerous Info for Upstream --}}
        @else
            @can('store u_dangerous')
                <button type="submit" form="form-main" formaction="{{ $dangerous->id ? route('backadmin.dangerous_infos.update', $dangerous->id) : route('backadmin.dangerous_infos.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
            @endcan
        @endif


    @endif


    @if ($dangerous->id)
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
            </button>    
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
                <a href="{{
                        str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification' ?
                        route('backadmin.downstreams.edit', ['downstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks']) :
                        route('backadmin.upstreams.edit', ['upstream' => $dangerous->notification->id, 'focus' => 'dangerous_risks'])
                    }}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
                {{-- @can('delete dangerous')
                @if(in_array($dangerous->notification->status, ['open', 'draft']))
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                @endif                
                @endcan                 --}}
                @if(in_array($dangerous->notification->status, ['open', 'draft']))
                    @if(str_replace('App\\Models\\', '', $dangerous->di_type) === 'DownStreamNotification')
                        @can('delete d_dangerous')
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                        @endcan
                    @else
                        @can('delete u_dangerous')
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                        @endcan
                    @endif
                @endif
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
                    <input name="notification_type" hidden value="{{request()->input('notification_type')}}">
                    <input name="notification_id" hidden value="{{request()->input('notification_id')}}">
                    @csrf
                    @if ($dangerous->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="name" class="form-label required">Jenis Bahaya yang Diidentifikasi</label>
                                <input
                                    autocomplete="disabled"
                                    type="text" 
                                    name="name"
                                    v-model="dangerous.name" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Jenis Bahaya" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-12 form-group">
                                <label for="category_id" class="form-label required">Kategori Bahaya</small></label>
                                    <select
                                        id="category_id" 
                                        name="category_id" 
                                        v-model="dangerous.category_id" 
                                        class="form-control @error('category_id') {{ 'is-invalid' }} @enderror">
                        
                                    </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group" v-show="dangerous1" v-cloak>
                                <label for="cl1_id" class="form-label required">Kategori Bahaya (Isian 1)</small></label>
                                    <input name="cl1_id_show" hidden :value="dangerous1? 1:0">
                                    <select
                                        id="cl1_id" 
                                        name="cl1_id" 
                                        class="form-control @error('cl1_id') {{ 'is-invalid' }} @enderror">
                        
                                    </select>
                                @error('cl1_id')
                                    <small class="text-danger">{{ $errors->first('cl1_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group" v-show="dangerous2" v-cloak>
                                <label for="cl2_id" class="form-label required">Kategori Bahaya (Isian 2)</small></label>
                                    <input name="cl2_id_show" hidden :value="dangerous2? 1:0">
                                    <select
                                        id="cl2_id" 
                                        name="cl2_id" 
                                        class="form-control @error('cl2_id') {{ 'is-invalid' }} @enderror">
                        
                                    </select>
                                @error('cl2_id')
                                    <small class="text-danger">{{ $errors->first('cl2_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group" v-show="dangerous3" v-cloak>
                                <label for="cl3_id" class="form-label required">Kategori Bahaya (Isian 3)</small></label>
                                    <input name="cl3_id_show" hidden :value="dangerous3? 1:0">
                                    <select
                                        id="cl3_id" 
                                        name="cl3_id" 
                                        class="form-control @error('cl3_id') {{ 'is-invalid' }} @enderror">
                                    </select>
                                @error('cl3_id')
                                    <small class="text-danger">{{ $errors->first('cl3_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="col-12 col-md-6 form-group">
                                <label for="name_result" class="form-label">Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
                                <input type="text" 
                                    autocomplete="disabled"
                                    name="name_result"
                                    v-model="dangerous.name_result" 
                                    class="form-control @error('name_result') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Hasil Uji" autocomplete="off">
                                @error('name_result')
                                    <small class="text-danger">{{ $errors->first('name_result') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="uom_result_id" class="form-label">Satuan Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
                                    <select
                                        id="uom_result_id" 
                                        name="uom_result_id" 
                                        v-model="dangerous.uom_result_id" 
                                        class="form-control @error('uom_result_id') {{ 'is-invalid' }} @enderror">                        
                                    </select>
                                @error('uom_result_id')
                                    <small class="text-danger">{{ $errors->first('uom_result_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            @if($dangerous->id)
                            <div class="col-12 col-md-12 form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="laboratorium" class="form-label ">Sampling</label>
                                    @if(in_array($dangerous->notification->status, ['open', 'draft']))
                                    <button type="button" v-on:click="openSamplingModal('add', null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                    @endif
                                </div>
                                <table v-cloak id="table-sampling" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah Sampel</th>
                                            <th>Metode</th>
                                            <th>Tempat Pengambilan</th>
                                            @if(in_array($dangerous->notification->status, ['open', 'draft']))
                                            <th class="bi-table-col-action-1">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- .col-md-6.form-group -->
                            @endif
                        
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Analisis</div>
                            </div>
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="laboratorium" class="form-label ">Laboratorium</label>
                                <input type="text" 
                                    name="laboratorium"
                                    v-model="dangerous.laboratorium" 
                                    class="form-control @error('laboratorium') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Analisis Laboratorium" autocomplete="off">
                                @error('laboratorium')
                                    <small class="text-danger">{{ $errors->first('laboratorium') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="matrix" class="form-label ">Matriks</label>
                                <input type="text" 
                                    name="matrix"
                                    v-model="dangerous.matrix" 
                                    class="form-control @error('matrix') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Matriks" autocomplete="off">
                                @error('matrix')
                                    <small class="text-danger">{{ $errors->first('matrix') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            <div class="divider divider-left col-12">
                                <div class="divider-text">Standar yang Berlaku</div>
                            </div>
                            <div class="col-12 col-md-6 form-group">    
                                <label for="scope" class="form-label ">Scope</label>
                                <input type="text" 
                                    name="scope"
                                    v-model="dangerous.scope" 
                                    class="form-control @error('scope') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Scope" autocomplete="off">
                                @error('scope')
                                    <small class="text-danger">{{ $errors->first('scope') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-6 form-group">
                                <label for="max_tollerance" class="form-label ">Maksimum Batas yang Diijinkan</label>
                                <input type="text" 
                                    name="max_tollerance"
                                    v-model="dangerous.max_tollerance" 
                                    class="form-control @error('max_tollerance') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Maksimum Batas yang Diijinkan" autocomplete="off">
                                @error('max_tollerance')
                                    <small class="text-danger">{{ $errors->first('max_tollerance') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                            
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>

                <div class="modal fade" id="sampling-modal" tabindex="-1" role="dialog" aria-labelledby="modalAddsampling" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="sampling-modal-form" action="#" method="GET">                    
                                <div class="modal-header">
                                    <h4 v-show="samplingModal.state !== 'delete'" class="modal-title" id="modalAddsampling">Tambah Sampling</h4>
                                    <h4 v-show="samplingModal.state === 'delete'" class="modal-title" id="modalAddsampling">Konfirmasi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" v-show="samplingModal.state !== 'delete'">
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label required">Tanggal Sampling</label>
                                            <input placeholder="Masukan Tanggal Sampling" id="sampling_date" name="sampling_date" class="form-control date read-only-white" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label required">Jumlah Sampling</label>
                                            <input placeholder="Masukan Jumlah Sampling" id="sampling_count" name="sampling_count" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label">Metode Sampling</label>
                                            <input placeholder="Masukan Metode Sampling" id="sampling_method" name="sampling_method" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="col-12 col-md-12 form-group" >
                                            <label class="form-label">Tempat Pengambilan Sampling</label>
                                            <input placeholder="Masukan Tempat Pengambilan Sampling" id="sampling_place" name="sampling_place" class="form-control" autocomplete="off"/>
                                        </div>
                                    </div>
                
                                    <div v-show="samplingModal.state === 'delete'">
                                        <p class="mb-0">Apakah Anda yakin akan menghapus Sampling ini?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button v-if="samplingModal.state !== 'delete'" type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                    <button v-if="samplingModal.state !== 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Tambahkan</button>
                                    <button v-if="samplingModal.state === 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-outline-primary">Ya, Hapus</button>
                                    <button v-if="samplingModal.state === 'delete'"  type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($dangerous->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.dangerous_infos.destroy', $dangerous->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Info Bahaya ini?</p>
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
    <script src="{{ asset('backadmin/theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
@endsection

@push('page-js')
@include('backadmin.dangerous_info.script')
<script>
    $(document).ready(function(){
        console.log('ready log section form')
        @if(isset($dangerous->notification))
        @if(!in_array($dangerous->notification->status, ['open', 'draft']))
            $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
            $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
        @endif
        @endif
    })
</script>
@endpush