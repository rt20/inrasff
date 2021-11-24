<div class="row" id="attachment-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Lampiran</h4>
            @if (in_array($upstream->status, ['open']))
                @can('store attachment')
                <button type="button" v-on:click="openAttachmentModal('add', null , null)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                @endcan
            @endif
            {{-- <label for="table-risk" class="form-label ">Daftar Resiko</label> --}}
        </div>
        <table id="table-attachment" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Info Lampiran</th>
                    @if (in_array($upstream->status, ['open']))
                    @can('delete attachment')
                    <th class="bi-table-col-action-1">Aksi</th>
                    @endcan
                    @endif
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
                                        <input placeholder="Silahkan Masukan Judul" name="title_attachment" id="title_attachment" class="form-control" type="text" value="">
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
                                        <input name="attachment" id="attachment" class="form-control f-attachment" type="file">
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

@push('page-js')
<script>
    function openAttachmentModal(state, id=null, item = {id:null}){
        na.openAttachmentModal(state, id, item)
    }
    let na = Vue.createApp({
        data() {
            return {
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

        },
        mounted() {
            $('.select2-dr').select2();
            let icon = feather.icons['trash'].toSvg();
            this.table_attachment = $('#table-attachment').DataTable({
                    ajax:{
                        url:"{{route('backadmin.dt.attachment_n_upstreams')}}",
                        data: function(data) {
                            data.na_id = '{{$upstream->id}}'
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
                        @if (in_array($upstream->status, ['open']))
                        @can('delete attachment')
                        {
                            data: 'id',
                            className: 'text-center',
                            orderable: false,
                            searchable: false, 
                            render: function(data, type, row, meta) {
                                return `<a href="#" onclick="openAttachmentModal('delete', `+data+`)" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                            } 
                        }
                        @endcan
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
                            return;
                        }
                        var url = `{{ route('backadmin.upstreams.add-attachment') }}`
                        var formData = new FormData()
                        
                        formData.append('notification_type', 'upstream')
                        formData.append('notification_id', {{$upstream->id}})
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
                        var url = `{{ route('backadmin.upstreams.delete-attachment', ':id') }}`
                        url = url.replace(":id", this.attachmentModal.item.id)
                        resp = await destroy(url)      
                                      
                        break;
                
                    default:
                        break;
                }

                        
                if(resp?.data?.status?.localeCompare('ok')==0){
                    $('#modal-attachment').modal('hide').on('hidden.bs.modal', function(){
                        na.attachmentModal.loading = 0    
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
                    this.attachmentModal.error = resp?.data?.message
                }
                
                
            },
        }
    }).mount('#attachment-section');

</script>
@endpush