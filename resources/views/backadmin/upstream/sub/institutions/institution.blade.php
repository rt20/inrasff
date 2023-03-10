<div class="d-flex justify-content-between align-items-center mb-1">
    <h4>Daftar Penindak</h4>
</div>
<div class="row">
    
    <div class="col-12 col-md-12 form-group">
        <div class="d-flex justify-content-between align-items-center">
            <label for="title" class="form-label">Lembaga yang perlu menindaklanjuti</label>
            @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                @can('store_institution upstream')
                {{-- <button type="button" v-on:click="openInstitutionModal('add', null , null, true)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button> --}}
                @endcan
            @endif
        </div>
        
        <table v-cloak  id="table-permission-rw" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="w-50">Lembaga</th>
                        <th class="w-25">Status</th>
                    {{-- @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                    @can('delete_institution upstream')
                    <th class="bi-table-col-action-1">Aksi</th>
                    @endcan
                    @endif --}}
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div class="col-12 col-md-12 form-group">
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <label for="title" class="form-label"> Lembaga lain yang terkait</label>
            @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                @can('store_institution upstream')
                {{-- <button type="button" v-on:click="openInstitutionModal('add')" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button> --}}
                @endcan
            @endif
        </div>
        
        <table v-cloak  id="table-permission-r" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="w-50">Lembaga</th>
                    
                    <th class="w-25">Status</th>
                    {{--
                        @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                        @can('delete_institution upstream')
                        <th class="bi-table-col-action-1">Aksi</th>
                        @endcan
                    @endif
                    --}}
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

{{-- <section class="bi-form-main">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h4>Informasi Pengguna yang Menindaklanjuti</h4>
    </div>

    <div class="row">    
        <div class="col-12 col-md-12 form-group">
            <div class="d-flex justify-content-between align-items-center">
                <label for="title" class="form-label">Pengguna yang perlu menindaklanjuti</label>
                @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                    <button type="button" v-on:click="openInstitutionModal('add', null , null, true)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
                @endif
            </div>
            
            <table v-cloak  id="table-user" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Akun</th>
                        <th>Lembaga</th>
                        <th>Penanggung Jawab</th>
                        <th>Tipe</th>
                        @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section> --}}


@push('page-js')
<script>
    var selIns = null
    $(document).ready(function(){
        selIns = $('#f_institution_a').select2({
                ajax: {
                        url: "{{ route('backadmin.s2Opt.institutions') }}",
                        data: function(params){
                            let req = {
                                q:params.term,
                            };
                            return req;
                        },
                        processResults: function(data){
                            return {results: data};
                        },
                },
                minimumInputLength:1,
                placeholder: 'Masukkan Lembaga Terkait',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.name;
                }

            })
    })
    function openInstitutionModal(state, id=null, item = {id:null}, institutionW=false){
        console.log("Halo")
        form_institution.openInstitutionModal(state, id, item, institutionW)
        
    }

    let form_institution = Vue.createApp({
        data() {
            return {
                table_r : null,
                table_rw: null,
                table_user: null,
                institutionW: false,
                institutionModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: ''
                },
                validatorItem : [
                    {
                        title: 'institution_id',
                        name : 'institution_id',
                        input: 'select',
                        required: true,
                        parse: null
                    },
                ],
            }
        },
        created() {
            
        },
        mounted() {
            

            let icon = feather.icons['trash'].toSvg();
            this.table_r = $('#table-permission-r').DataTable({
                ajax:{
                    url:"{{route('backadmin.up_stream_institutions.index')}}",
                    data: function(data) {
                        data.read = 1
                        data.write = 0
                        data.us_id = '{{$upstream->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'institution.name' },
                    { 
                        data: 'status' ,
                        searchable:false,
                        orderable:false,
                        className: 'text-center',
                        render: function(data,type,row,meta){
                            return '<span class="badge badge-pill badge-light-' + row.status_class + ' px-1 py-50">' + row.status_label + '</span>'
                        }
                    },
                    
                    @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                    @can('delete_institution upstream')
                    /*
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openInstitutionModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                    */
                    @endcan
                    @endif
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

            this.table_rw = $('#table-permission-rw').DataTable({
                ajax:{
                    url:"{{route('backadmin.up_stream_institutions.index')}}",
                    data: function(data) {
                        data.read = 1
                        data.write = 1
                        data.us_id = '{{$upstream->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'institution.name' },
                    { 
                        data: 'status' ,
                        searchable:false,
                        orderable:false,
                        className: 'text-center',
                        render: function(data,type,row,meta){
                            return '<span class="badge badge-pill badge-light-' + row.status_class + ' px-1 py-50">' + row.status_label + '</span>'
                        }
                    },
                    @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                    @can('delete_institution upstream')
                    /*
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openInstitutionModal('delete', `+data+`)" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                    */
                    @endcan
                    @endif
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

            this.table_user = $('#table-user').DataTable({
                ajax:{
                    url:"{{route('backadmin.up_stream_user_accesses.index')}}",
                    data: function(data) {
                        data.upstream_id = '{{$upstream->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'user.fullname' },
                    { data: 'user.institution.name' },
                    { data: 'user.responsible_name' },
                    { data: 'user.institution.type_label' },
                    @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openInstitutionModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                    @endif
                ],
                order: [[0, 'asc']],
                language: dtLangId
            })

        },
        computed: {

        },
        methods: {
            openInstitutionModal(state, id=null, item = {id:null}, institutionW=false){
                console.log("Halo")

                $('#f_institution_a').val(null).trigger('change')
                
                $('.text-warn').remove();
                this.institutionModal.state = state;
                this.institutionW = institutionW
                switch (this.institutionModal.state) {
                    case 'add':
                    
                        this.institutionModal.item = item;                        
                        break;
                    case 'delete':
                        // this.institutionModal.item = Object.assign({}, this.slider.slider_image[index]);
                        this.institutionModal.item = {id:id};   
                        break;
                    
                    default:
                        break;
                }
                $('#institution-modal').modal({ backdrop: 'static', keyboard: false })
            },
            async submitItem(e){
                e.preventDefault()
                $('.text-warn').remove();
                let invalid;

                switch (this.institutionModal.state) {
                    case 'add':
                        this.validatorItem.forEach(el => {
                            if(el.required==true)
                            {
                                if(!$(el.input+'[name="'+el.title+'"]').val() ){
                                    $(el.input+'[name="'+el.title+'"]').parent().append(`
                                        <small class="text-danger text-warn">Field ini harus diisi</small>
                                    `);
                                    invalid = true;
                                }
                            }
                        });

                        if(invalid)
                            return;

                        var url = `{{ route('backadmin.up_stream_institutions.add') }}`
                        var formData = new FormData()
                        this.validatorItem.forEach(el => {
                            var value = $(el.input+'[name="'+el.title+'"]').val()
                            console.log(value)
                            switch (el.parse) {
                                case 'numeric':
                                    value = value.replace(/\./g, '')
                                    break;
                            
                                default:
                                    break;
                            }
                            formData.append(el.name, value)
                        });
                        formData.append('us_id', {{$upstream->id}})
                        if(this.institutionW)
                            formData.append('write', this.institutionW)
                        var resp = await post(url,formData)
                        console.log(resp)
                            if(resp?.data?.status?.localeCompare('ok')==0){
                                $('#institution-modal').modal('hide')
                                if(this.institutionW){
                                    this.table_rw.ajax.reload()
                                    this.table_user.ajax.reload()                                }
                                else
                                    this.table_r.ajax.reload()
                                this.institutionW = false

                            }else{
                                alert(resp?.data?.message)
                            }    
                        
                        break;
                
                    case 'delete': 
                        var url = `{{ route('backadmin.up_stream_institutions.delete', '__id') }}`
                        url = url.replace("__id", this.institutionModal?.item?.id)
                        var resp = await destroy(url)
                        console.log(resp)
                        if(resp?.data?.status?.localeCompare('ok')==0){
                            $('#institution-modal').modal('hide')
                                this.table_rw.ajax.reload()
                                this.table_r.ajax.reload()
                                this.table_user.ajax.reload()

                        }else{
                            alert(resp?.data?.message)
                        }   
                        break;
                    
                    default:
                        break;
                }
                
            },
        }
    }).mount('#app-institution');
</script>
@endpush