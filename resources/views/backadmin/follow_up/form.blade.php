@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
@if($follow_up->id != null)
<li class="breadcrumb-item">
    <a 
    href="{{ 
        str_replace('App\\Models\\', '', $follow_up->fun_type) === 'DownStreamNotification' ?
        route('backadmin.downstreams.edit', $follow_up->notification->id) :
        route('backadmin.upstreams.edit', $follow_up->notification->id)
    
    }}"
    
    >{{ $follow_up->notification->number }}</a></li>
    @else
    <li class="breadcrumb-item">
    <a 
    href="{{ 
        request()->input('notification_type') === 'downstream'?
        route('backadmin.downstreams.edit', request()->input('notification_id')) :
        route('backadmin.upstreams.edit', request()->input('notification_id'))
    
    }}"
    
    >{{ str_replace('App\\Models\\', '', $follow_up->fun_type) === 'DownStreamNotification' ? 'Downstream' : 'Upstream' }} Asal</a></li>
@endif
<li class="breadcrumb-item">Tindak Lanjut</li>
@endsection

@section('actions')
    @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
    <button type="submit" form="form-main" formaction="{{ $follow_up->id ? route('backadmin.follow_ups.update', $follow_up->id) : route('backadmin.follow_ups.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @endif
    @if ($follow_up->id)
        @if (in_array($follow_up->status, ['draft']))
        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modal-process"><i class="mr-75" data-feather="settings"></i>Proses</a>
        @endif
        @if (in_array($follow_up->status, ['on process']))
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-accept"><i class="mr-75" data-feather="check"></i>Setujui</a>
        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject"><i class="mr-75" data-feather="x"></i>Tolak</a>
        @endif
        {{-- @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
        @endif --}}
        <div class="btn-group">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
            </button>    
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
                @if($follow_up->id != null)
                    <a href="{{ 
                        str_replace('App\\Models\\', '', $follow_up->fun_type) === 'DownStreamNotification' ?
                        route('backadmin.downstreams.edit', $follow_up->notification->id) :
                        route('backadmin.upstreams.edit', $follow_up->notification->id)
                    
                    }}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
                    
                    @else
                    <a href="{{ 
                        request()->input('notification_type') === 'downstream'?
                        route('backadmin.downstreams.edit', request()->input('notification_id')) :
                        route('backadmin.upstreams.edit', request()->input('notification_id'))
                    
                    }}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
                @endif
                
                @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
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
                    @if ($follow_up->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                            <span class="badge badge-pill badge-light-{{ $follow_up->status_class }} px-2 py-50">{{ $follow_up->status_label }}</span>
                        </div>
    
                        <div class="row">
                        <div class="col-12 col-md-12 form-group">
                                <label for="title" class="form-label required">Judul</label>
                                <input type="text" 
                                    name="title"
                                    v-model="follow_up.title" 
                                    class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Judul" autocomplete="off">
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        
                            <div class="col-12 col-md-12 form-group">
                                <label for="description" class="form-label ">Pesan / Deskripsi</label>
                                <textarea 
                                    rows="10"
                                    v-model="follow_up.description" 
                                    name="description" 
                                    class="form-control"
                                    placeholder="Masukan Pesan / Deskripsi"
                                    autocomplete="off"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            @if($follow_up->id != null)
                            <div class="col-12 col-md-12 form-group">
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="description" class="form-label ">Lampiran</label>
                                    @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
                                    <button type="button" v-on:click="openAttachmentModal('add', null , null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                    @endif
                                </div>
                                <table id="table-attachment" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
                                            <th class="bi-table-col-action-1">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
                <div class="modal fade" id="modal-attachment" tabindex="-1" role="dialog" aria-labelledby="modalAttachment" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="form-attachment" action="#" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 v-show="attachmentModal.state !== 'delete'" class="modal-title" id="modalAttachment">Tambah Lampiran</h4>
                                        <h4 v-show="attachmentModal.state === 'delete'" class="modal-title" id="modalAttachment">Hapus Lampiran</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div v-show="attachmentModal.state !== 'delete'">
                                            <div class="alert alert-danger mb-50" v-if="attachmentModal.error != ''">
                                                <div class="alert-body">@{{ attachmentModal.error }}</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label required" for="attachment">Lampiran</label>
                                                <input name="attachment" id="attachment" class="form-control f-attachment" type="file">
                                            </div>
                                        </div>
                                        <div v-show="attachmentModal.state === 'delete'">
                                            <p class="mb-0">Apakah Anda yakin akan menghapus Lampiran ini?</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button v-show="attachmentModal.state !== 'delete'" type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                        
                                        
                                        <button type="submit" class="btn btn-outline-primary" form="form-address" v-if="attachmentModal.state === 'delete'" v-on:click="submitAttachmentForm($event)">Ya, Hapus</button>
                                        <button v-show="attachmentModal.state === 'delete'" type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                        <button 
                                            type="submit" 
                                            class="btn btn-primary" 
                                            form="form-address" 
                                            v-if="attachmentModal.state === 'add'" 
                                            v-on:click="submitAttachmentForm($event)">
                                            Tambah
                                        </button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($follow_up->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.follow_ups.destroy', $follow_up->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Tindak Lanjut ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-process" tabindex="-1" role="dialog" aria-labelledby="modalProcess" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.follow_ups.process', $follow_up->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcess">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Mengajukan Tindak Lanjut ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Ajukan</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-accept" tabindex="-1" role="dialog" aria-labelledby="modalAccept" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.follow_ups.accept', $follow_up->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalAccept">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Menyetujui Tindak Lanjut ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Setujui</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-reject" tabindex="-1" role="dialog" aria-labelledby="modalReject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.follow_ups.reject', $follow_up->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalReject">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Menolak Tindak Lanjut ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Tolak</button>
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
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
@endsection

@push('page-js')
<script>
    function openAttachmentModal(state, id=null, item = {id:null}){
        form.openAttachmentModal(state, id, item)
    }
    let form = Vue.createApp({
        data() {
            return {
                follow_up: {},
                attachmentModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: ''
                },
                validatorAttachment : [
                    {
                        name: 'attachment',
                        title: 'attachment',
                        input: 'input',
                        active: true,
                    },
                ],
                table_attachment: null,
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            follow_up = {!! json_encode($follow_up) !!};
            console.log(follow_up)
            this.follow_up = {
                title: old.title ?? follow_up.title ?? '',
                description: old.description ?? follow_up.description ?? '',          
                
            }

            console.log(this.follow_up)
        },
        mounted() {
            $('.select2-dr').select2();
            let icon = feather.icons['trash'].toSvg();
            this.table_attachment = $('#table-attachment').DataTable({
                    ajax:{
                        url:"{{route('backadmin.dt.attachment_fu')}}",
                        data: function(data) {
                            data.fun_id = '{{$follow_up->id}}'
                        }
                    },
                    serverSide: true,
                    processing: true,
                    columns: [
                        { 
                            data: 'title' ,
                            render: function(data, type, row, meta){
                                return `<a href="`+row.origin+`" target="_blank">` + data + `</a>`
                            }
                        },
                        @if (!in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
                        {
                            data: 'id',
                            className: 'text-center',
                            orderable: false,
                            searchable: false, 
                            render: function(data, type, row, meta) {
                                return `<a href="#" onclick="openAttachmentModal('delete', `+data+`)" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                            } 
                        }
                        @endif
                    ],
                    order: [[0, 'desc']],
                    language: dtLangId
                })
        },
        computed: {

        },
        methods: {
            openAttachmentModal(state, id=null, item = {id:null}){
                console.log("open")
                // console.log($('#form-attachment'))
                $('.f-attachment').val(null)
                $('.text-danger').remove();
                this.attachmentModal.state = state;
                this.attachmentModal.error = '';
                
                switch (this.attachmentModal.state) {
                    case 'add':
                        this.attachmentModal.item = item         
                        break;                    
                    
                    case 'delete':
                        this.attachmentModal.item = {id:id};   
                        break;
                    
                    default:
                        break;
                }

                $('#modal-attachment').modal({ backdrop: 'static', keyboard: false })
            },
            async submitAttachmentForm(e) {
                e.preventDefault();
                // return
                
                $('.text-danger').remove();
                let invalid;
                var resp = null
                switch (this.attachmentModal.state) {
                    case 'add':
                        this.validatorAttachment.forEach(el => {                    
                            if(!$(el.input+'[name="'+el.title+'"]').val()){
                                if(el.active){
                                    $(el.input+'[name="'+el.title+'"]').parent().append(`
                                        <small class="text-danger">Field ini harus diisi</small>
                                    `);
                                    invalid = true;
                                }
                            }
                        });
                        if(invalid){
                            return;
                        }
                        var url = `{{ route('backadmin.follow_ups.add-attachment') }}`
                        var formData = new FormData()
                        formData.append( 'fun_id',{{$follow_up->id}})
                        formData.append('attachment', $('input[name="attachment"]')[0].files[0])
                        resp = await post(
                            url,
                            formData,
                            {
                                headers:{   
                                'Content-Type': 'multipart/form-data'
                            }})                        
                        
                        break;

                    case 'delete':
                        var url = `{{ route('backadmin.follow_ups.delete-attachment', ':id') }}`
                        url = url.replace(":id", this.attachmentModal.item.id)
                        resp = await destroy(url)      
                                      
                        break;
                
                    default:
                        break;
                }

                        
                if(resp?.data?.status?.localeCompare('ok')==0){
                    $('#modal-attachment').modal('hide')
                    this.table_attachment.ajax.reload()
                    setTimeout(() => {
                    console.log("Wait time out")
                        feather.replace({
                            width: 14,
                            height: 14
                        });                        
                    }, 200)
                }else{
                    // alert(resp?.data?.message)
                    this.attachmentModal.error = resp?.data?.message
                }
                
                
            },
        }
    }).mount('#app');

    $(document).ready(function(){
        console.log('ready log section form')
        @if (in_array($follow_up->status, ['on process', 'accepted', 'rejected']))
            $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
            $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
        @endif
    })
</script>
@endpush