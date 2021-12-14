@extends('backadmin.layouts.master')

@section('vendor-css')
@include('backadmin.layouts.style_datatables')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/dropify/dist/css/dropify.css') }}"> 
<link rel="stylesheet" href="{{ asset('backadmin/vendors/summernote/summernote.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.notifications.index') }}">Informasi Awal</a></li>
@endsection

@section('actions')
    @if (!in_array($notification->status, ['processed']))
    @can('store notification')
    <button type="submit" form="form-main" formaction="{{ $notification->id ? route('backadmin.notifications.update', $notification->id) : route('backadmin.notifications.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @endcan
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
                    @can('process_downstream notification')
                        <a href="#" data-toggle="modal" data-target="#modal-process-downstream" class="dropdown-item"><i class="mr-75" data-feather="settings"></i>Downstream</a>
                    @endcan
                    @can('process_upstream notification')
                        <a href="#" data-toggle="modal" data-target="#modal-process-upstream"  class="dropdown-item"><i class="mr-75" data-feather="settings"></i>Upstream</a>
                    @endcan
                    @can('delete notification')
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
                    @endcan
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
                                    placeholder="Masukkan Judul" autocomplete="off"
                                    @if(in_array(Auth::user()->type, ['ncp'])) readonly="" @endif>
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
                                    placeholder="Masukkan Nomor" autocomplete="off"
                                    @if(in_array(Auth::user()->type, ['ncp'])) readonly="" @endif>
                                @error('number')
                                    <small class="text-danger">{{ $errors->first('number') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="description" class="form-label">Dekripsi</label>
                                <textarea
                                    id="summernote"
                                    type="text" 
                                    name="description"
                                    class="form-control @error('description') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Deskripsi" autocomplete="off"
                                    @if(in_array(Auth::user()->type, ['ncp'])) readonly="" @endif>{{old()? old('description') : ($notification->description??'')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            <div class="col-12 col-md-12 form-group">
        
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Lampiran</h4>
                                    @can('edit notification')
                                    @if (in_array($notification->status, ['read']))
                                        @can('store u_attachment')
                                        <button type="button" v-on:click="openAttachmentModal('add', null , null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                                        @endcan
                                    @endif
                                    @endcan
                                    {{-- <label for="table-risk" class="form-label ">Daftar Resiko</label> --}}
                                </div>
                                <table id="table-attachment" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Info Lampiran</th>
                                            <th>Tanggal Ditambahkan</th>
                                            @if (in_array($notification->status, ['read']))
                                            {{-- @can('delete attachment') --}}
                                            <th class="bi-table-col-action-1">Aksi</th>
                                            {{-- @endcan --}}
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>

                <div class="modal fade" id="modal-attachment" tabindex="-1" role="dialog" aria-labelledby="modalAttachment" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="form-attachment" action="#" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 v-show="attachmentModal.state !== 'delete'" class="modal-title" id="modalAttachment">Tambah Lampiran</h4>
                                        <h4 v-show="attachmentModal.state === 'delete'" class="modal-title" id="modalAttachment">Konfirmasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center mt-2" v-if="attachmentModal.loading==1">
                                            <div class="spinner-border text-success" style="width: 10rem; height: 10rem"  role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-1" v-if="attachmentModal.loading==1">
                                            <h2>Memproses</h2>
                                        </div>
                                        <div v-if="attachmentModal.loading == 0">
                                            <div v-show="attachmentModal.state !== 'delete'">
                                                <div class="alert alert-danger mb-50" v-if="attachmentModal.error != ''">
                                                    <div class="alert-body">@{{ attachmentModal.error }}</div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label required" for="title_attachment">Judul</label>
                                                    <input autocomplete="off" placeholder="Silahkan Masukan Judul" name="title_attachment" id="title_attachment" class="form-control" type="text" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label required" for="title">Info Lampiran</label>
                                                    <select name="info" id="info" class="form-control">
                                                        <option value="" selected>-Silahkan Pilih Info Lampiran-</option>
                                                        @foreach ($type_infos as $key => $ti)
                                                            <option value="{{$key}}">{{$ti['label']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label required" for="attachment">Lampiran</label>
                                                    <input name="attachment" id="attachment" class="form-control f-attachment dropify" data-max-file-size="10M" type="file">
                                                    <small>*format: pdf, excel, jpg, jpeg, png. Max:10MB</small>
                                                </div>
                                            </div>
                                            <div v-show="attachmentModal.state === 'delete'">
                                                <p class="mb-0">Apakah Anda yakin akan menghapus Lampiran ini?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" v-if="attachmentModal.loading == 0">
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
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ya, Proses Downstream</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-process-upstream" tabindex="-1" role="dialog" aria-labelledby="modalProcessUpstream" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.notifications.process-upstream', $notification->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalProcess">Konfirmasi Proses Menjadi Upstream</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan membuat Notifikasi ini menjadi Notifikasi Upstream?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ya, Proses Upstream</button>
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
                notification: {
                },
                attachmentModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: '',
                    loading: 0
                },
                validatorAttachment : [
                    {
                        name: 'attachment',
                        title: 'attachment',
                        input: 'input',
                        active: true,
                    },
                    {
                        name: 'title_attachment',
                        title: 'title_attachment',
                        input: 'input',
                        active: true,
                    },
                    {
                        name: 'info',
                        title: 'info',
                        input: 'select',
                        active: true,
                    },
                ],
                table_attachment: null,
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            notification = {!! json_encode($notification) !!};
            this.notification = {
                title: old.title ?? notification.title ?? '',     
                number: old.number ?? notification.number ?? '',                
            }
        },
        mounted() {
            $('.dropify').dropify();
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

            @can('edit notification') 
                $('#summernote').summernote('enable');
            @else
                $('#summernote').summernote('disable');
            @endcan
            

            let icon = feather.icons['trash'].toSvg();
            this.table_attachment = $('#table-attachment').DataTable({
                ajax:{
                    url:"{{route('backadmin.dt.attachment_n_notifications')}}",
                    data: function(data) {
                        data.na_id = '{{$notification->id}}'
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
                    {
                        data: 'info_label',
                        searchable:false,
                        orderable:false,
                    },
                    { 
                        data: 'created_at' ,
                        render: function(data, type, row, meta){
                            return moment(data).format('D MMMM YYYY HH:mm:ss')
                        }
                    },
                    @if (in_array($notification->status, ['read']))
                    
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

            @if (in_array($notification->status, ['processed']))
                $('.bi-form-main input, .bi-form-main select').prop('disabled', true);
                $('#summernote').summernote('disable');
                $('.read-only-white').removeClass('read-only-white')
                $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
            @endif
        },
        computed: {

        },
        methods: {
            openAttachmentModal(state, id=null, item = {id:null}){
                console.log("open")
                $('.f-attachment').val(null)
                $('#form-attachment').trigger('reset')
                $('.text-danger').remove();
                this.attachmentModal.state = state;
                this.attachmentModal.error = '';
                this.attachmentModal.loading = 0
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
                this.attachmentModal.loading = 1
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
                            this.attachmentModal.loading = 0
                            return;
                        }
                        var url = `{{ route('backadmin.notifications.add-attachment') }}`
                        var formData = new FormData()
                        
                        formData.append('notification_type', 'notification')
                        formData.append('notification_id', {{$notification->id}})
                        formData.append('attachment', $('input[name="attachment"]')[0].files[0])
                        formData.append('info', $('select[name="info"]').val())
                        formData.append('title_attachment', $('input[name="title_attachment"]').val())
                        resp = await post(
                            url,
                            formData,
                            {
                                headers:{   
                                'Content-Type': 'multipart/form-data'
                            }})                        
                        
                        break;

                    case 'delete':
                        var url = `{{ route('backadmin.notifications.delete-attachment', ':id') }}`
                        url = url.replace(":id", this.attachmentModal.item.id)
                        resp = await destroy(url)      
                                      
                        break;
                
                    default:
                        break;
                }

                        
                if(resp?.data?.status?.localeCompare('ok')==0){
                    $('#modal-attachment').modal('hide').on('hidden.bs.modal', function(){
                        form.attachmentModal.loading = 0    
                    })
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
                    this.attachmentModal.loading = 0
                    this.attachmentModal.error = resp?.data?.message
                }
                
                
            },
        }
    }).mount('#app');
</script>
@endpush