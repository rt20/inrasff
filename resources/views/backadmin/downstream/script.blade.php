<script>
    function setSectionForm(section = "general"){
        $('#section-form').val(section)
    }

    function openInstitutionModal(state, id=null, item = {id:null}, institutionW=false){
        form.openInstitutionModal(state, id, item, institutionW)
    }

    let form = Vue.createApp({
        data() {
            return {
                downstream: {},
                availableTabs: [],
                activeTab: null,
                table_r : null,
                table_rw: null,
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
            // console.log("general")
            old = {!! json_encode(old()) !!};
            downstream = {!! json_encode($downstream) !!};
            // console.log(downstream)
            this.downstream = {
                id: downstream.id ?? '',
                title: old.title ?? downstream.title ?? '',
                number_ref: old.number_ref ?? downstream.number_ref ?? '',
                status_notif: old.status_notif ?? downstream.status_notif ?? '',
                type_notif: old.type_notif ?? downstream.type_notif ?? '',
                country_id: old.country_id ?? downstream.country_id ?? '',
                based_notif: old.based_notif ?? downstream.based_notif ?? '',
                origin_source_notif: old.origin_source_notif ?? downstream.origin_source_notif ?? '',
                source_notif: old.source_notif ?? downstream.source_notif ?? '',
                date_notif: old.date_notif ?? downstream.date_notif ?? '',

                product_name: old.product_name ?? downstream.product_name ?? '',
                category_product_name: old.category_product_name ?? downstream.category_product_name ?? '',
                brand_name: old.brand_name ?? downstream.brand_name ?? '',
                registration_number: old.registration_number ?? downstream.registration_number ?? '',
                package_product: old.package_product ?? downstream.package_product ?? '',

            }

            if(this.downstream.country_id !== ''){
                initS2FieldWithAjax(
                    '#country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.downstream.country_id},
                    ['code', 'name']
                )
            }
            
        },
        mounted() {
            $('.date').flatpickr();
            $('.select2').select2();

            $('select[name="origin_source_notif"]').on('change', function(e){
                form.downstream.origin_source_notif = e.target.value
                console.log(form.downstream)
            })

            $('select[name="status_notif"]').on('change', function(e){
                form.downstream.status_notif = e.target.value
            })

            $('select[name="type_notif"]').on('change', function(e){
                form.downstream.type_notif = e.target.value
            })

            $('select[name="source_notif"]').on('change', function(e){
                form.downstream.source_notif = e.target.value
            })

            $('#country_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.countries') }}",
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
               placeholder: 'Masukkan Negara Penotifikasi',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.downstream.country_id = e.target.value
            })

            let icon = feather.icons['trash'].toSvg();
            this.table_r = $('#table-permission-r').DataTable({
                ajax:{
                    url:"{{route('backadmin.down_stream_institutions.index')}}",
                    data: function(data) {
                        data.read = 1
                        data.write = 0
                        data.ds_id = '{{$downstream->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'institution.name' },
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openInstitutionModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

            this.table_rw = $('#table-permission-rw').DataTable({
                ajax:{
                    url:"{{route('backadmin.down_stream_institutions.index')}}",
                    data: function(data) {
                        data.read = 1
                        data.write = 1
                        data.ds_id = '{{$downstream->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'institution.name' },
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openInstitutionModal('delete', `+data+`)" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

            $('#f_institution').select2({
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
               placeholder: 'Masukkan Institusi Terkait',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.name;
                }

            })

        },
        computed: {

        },
        methods: {
            openInstitutionModal(state, id=null, item = {id:null}, institutionW=false){
                $('#f_institution').val(null).trigger('change')
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

                        var url = `{{ route('backadmin.down_stream_institutions.add') }}`
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
                        formData.append('ds_id', {{$downstream->id}})
                        if(this.institutionW)
                            formData.append('write', this.institutionW)
                        var resp = await post(url,formData)
                        console.log(resp)
                            if(resp?.data?.status?.localeCompare('ok')==0){
                                $('#institution-modal').modal('hide')
                                if(this.institutionW)
                                    this.table_rw.ajax.reload()
                                else
                                    this.table_r.ajax.reload()
                                this.institutionW = false

                            }else{
                                alert(resp?.data?.message)
                            }    
                        
                        break;
                
                    case 'delete': 
                        var url = `{{ route('backadmin.down_stream_institutions.delete', '__id') }}`
                        url = url.replace("__id", this.institutionModal?.item?.id)
                        var resp = await destroy(url)
                        console.log(resp)
                        if(resp?.data?.status?.localeCompare('ok')==0){
                            $('#institution-modal').modal('hide')
                                this.table_rw.ajax.reload()
                                this.table_r.ajax.reload()

                        }else{
                            alert(resp?.data?.message)
                        }   
                        break;
                    
                    default:
                        break;
                }
                
            }
        }
    }).mount('#app');
</script>