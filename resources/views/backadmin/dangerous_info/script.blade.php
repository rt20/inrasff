<script>
    function openSamplingModal(state, id=null, item = {id:null}){
        
        form.openSamplingModal(state, id, item)        
    }

    let form = Vue.createApp({
        data() {
            return {
                dangerous: {},
                dangerous1: false,
                dangerous2: false,
                dangerous3: false,
                table_sampling : null,
                samplingModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: ''
                },
                validatorSampling : [
                    {
                        title: 'sampling_date',
                        name : 'sampling_date',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_count',
                        name : 'sampling_count',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_method',
                        name : 'sampling_method',
                        input: 'input',
                        required: false,
                        parse: null
                    },

                    {
                        title: 'sampling_place',
                        name : 'sampling_place',
                        input: 'input',
                        required: false,
                        parse: null
                    },
                ],
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            dangerous = {!! json_encode($dangerous) !!}
            this.dangerous = {
                name: old.name ?? dangerous.name ?? '',
                category_id: old.category_id ?? dangerous.category_id ?? '',
                name_result: old.name_result ?? dangerous.name_result ?? '',
                uom_result_id: old.uom_result_id ?? dangerous.uom_result_id ?? '',
                laboratorium: old.laboratorium ?? dangerous.laboratorium ?? '',
                matrix: old.matrix ?? dangerous.matrix ?? '',
                scope: old.scope ?? dangerous.scope ?? '',
                max_tollerance: old.max_tollerance ?? dangerous.max_tollerance ?? '',                
                cl1_id: old.cl1_id ?? dangerous.cl1_id ?? '',
                cl2_id: old.cl2_id ?? dangerous.cl2_id ?? '',
                cl3_id: old.cl3_id ?? dangerous.cl3_id ?? '',
            }

            // // console.log(this.dangerous)

            if(this.dangerous.category_id !== ''){
                initS2FieldWithAjax(
                    '#category_id',
                    '{{route("backadmin.s2Init.dangerous_category")}}',
                    {id:this.dangerous.category_id},
                    ['name'],
                    function(res){
                        // console.log(res)
                        if(res.has_child){
                            form.dangerous1 = true
                        }
                    }
                )
            }

            if(this.dangerous.cl1_id !== ''){
                initS2FieldWithAjax(
                    '#cl1_id',
                    '{{route("backadmin.s2Init.dangerous_category_level")}}',
                    {id:this.dangerous.cl1_id},
                    ['name'],
                    function(res){
                        // console.log(res)
                        if(res.has_child){
                            form.dangerous2 = true
                        }
                    }
                )
            }

            if(this.dangerous.cl2_id !== ''){
                initS2FieldWithAjax(
                    '#cl2_id',
                    '{{route("backadmin.s2Init.dangerous_category_level")}}',
                    {id:this.dangerous.cl2_id},
                    ['name'],
                    function(res){
                        // console.log(res)
                        if(res.has_child){
                            form.dangerous3 = true
                        }
                    }
                )
            }

            if(this.dangerous.cl3_id !== ''){
                initS2FieldWithAjax(
                    '#cl3_id',
                    '{{route("backadmin.s2Init.dangerous_category_level")}}',
                    {id:this.dangerous.cl3_id},
                    ['name']
                )
            }

            if(this.dangerous.uom_result_id !== ''){
                initS2FieldWithAjax(
                    '#uom_result_id',
                    '{{route("backadmin.s2Init.uom_result")}}',
                    {id:this.dangerous.uom_result_id},
                    ['name']
                )
            }

            
        },
        mounted() {
            // $('.select2-dr').select2();
            $('.date').flatpickr();
            $('#sampling_count').keyup(function(e){
                var regex = /^[0-9]+$/;
                if (regex.test(e.target.value) !== true)
                    e.target.value = e.target.value.replace(/[^0-9]+/, '');
            })
            let icon = feather.icons['trash'].toSvg();
            this.table_sampling = $('#table-sampling').DataTable({
                ajax:{
                    url:"{{route('backadmin.dangerous_samplings.index')}}",
                    data: function(data) {
                        data.di_id = '{{$dangerous->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { 
                        data: 'sampling_date' ,
                        render: function(data, type, row, meta){
                            return moment(data).format('D MMMM YYYY')
                        }
                    },
                    { data: 'sampling_count' },
                    { 
                        data: 'sampling_method',
                        defaultContent: '-' 
                    },
                    { 
                        data: 'sampling_place',
                        defaultContent: '-'
                    },
                    @if($dangerous->id)
                    @if(in_array($dangerous->notification->status, ['open', 'draft']))
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<button type="button" onclick="openSamplingModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</button>`
                        } 
                    }
                    @endif
                    @endif
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })

            this.initiateS2(
                "#category_id",
                "{{route('backadmin.s2Opt.dangerous_category')}}",
                0,
                "Silahkan Pilih Kategori Bahaya",
                ['name'],
                function(e){
                    form.dangerous1=false
                    form.dangerous2=false
                    form.dangerous3=false
                    if(e.params.data.has_child){
                        form.dangerous1=true
                    }
                    form.dangerous.category_id = e.target.value
                    $('#cl1_id').val(null).trigger('change')
                    $('#cl2_id').val(null).trigger('change')
                    $('#cl3_id').val(null).trigger('change')
                }
            )

            this.initiateS2(
                "#cl1_id",
                "{{route('backadmin.s2Opt.dangerous_category_level')}}",
                0,
                "Silahkan Pilih Kategori Bahaya (Isian 1)",
                ['name'],
                function(e){
                    form.dangerous.cl1_id = e.target.value
                    form.dangerous2=false
                    form.dangerous3=false
                    if(e.params.data.has_child){
                        form.dangerous2=true
                    }
                    $('#cl2_id').val(null).trigger('change')
                    $('#cl3_id').val(null).trigger('change')
                },
                function(params){
                    let req = {
                        q: params.term,
                        dc_id: $('#category_id').val(),
                        level: 1
                    }
                    return req
                }
            )

            this.initiateS2(
                "#cl2_id",
                "{{route('backadmin.s2Opt.dangerous_category_level')}}",
                0,
                "Silahkan Pilih Kategori Bahaya (Isian 2)",
                ['name'],
                function(e){
                    form.dangerous.cl2_id = e.target.value
                    form.dangerous3=false
                    if(e.params.data.has_child){
                        form.dangerous3=true
                    }
                    $('#cl3_id').val(null).trigger('change')
                },
                function(params){
                    let req = {
                        q: params.term,
                        parent_id: $('#cl1_id').val(),
                        level: 2,
                    }
                    return req
                }
            )

            this.initiateS2(
                "#cl3_id",
                "{{route('backadmin.s2Opt.dangerous_category_level')}}",
                0,
                "Silahkan Pilih Kategori Bahaya (Isian 3)",
                ['name'],
                function(e){
                    form.dangerous.cl3_id = e.target.value
                },
                function(params){
                    let req = {
                        q: params.term,
                        parent_id: $('#cl2_id').val(),
                        level: 3
                    }
                    return req
                }
            )

            this.initiateS2(
                "#uom_result_id",
                "{{route('backadmin.s2Opt.uom_result')}}",
                0,
                "Silahkan Pilih Satuan Hasil Uji",
                ['name'],
                function(e){
                    form.dangerous.uom_result_id = e.target.value
                }
            )
        },
        computed: {

        },
        methods: {
            initiateS2(
                elId,
                url,
                minimumInputLength = 3,
                placeholder = "Masukan Pilihan",
                attrs,
                onSelect,
                paramsCallback= function (params) {
                    let req = {
                        q: params.term,
                    };
                    return req;
                }
            ){
                return initiateS2(
                    elId,
                    url,
                    minimumInputLength,
                    placeholder,
                    attrs,
                    onSelect,
                    paramsCallback 
                ) 
            },
            openSamplingModal(state, id=null, item = {id:null}){
                // console.log("Halo")

                $('#sampling-modal-form').trigger('reset')
                
                $('.text-warn').remove();
                this.samplingModal.state = state;
                switch (this.samplingModal.state) {
                    case 'add':                    
                        this.samplingModal.item = item;                        
                        break;
                    case 'delete':
                        // this.samplingModal.item = Object.assign({}, this.slider.slider_image[index]);
                        this.samplingModal.item = {id:id};   
                        break;
                    
                    default:
                        break;
                }
                $('#sampling-modal').modal({ backdrop: 'static', keyboard: false })
            },
            async submitItem(e){
                e.preventDefault()
                $('.text-warn').remove();
                let invalid;

                switch (this.samplingModal.state) {
                    case 'add':
                        this.validatorSampling.forEach(el => {
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

                        var url = `{{ route('backadmin.dangerous_samplings.add') }}`
                        var formData = new FormData()
                        this.validatorSampling.forEach(el => {
                            var value = $(el.input+'[name="'+el.title+'"]').val()
                            // console.log(value)
                            formData.append(el.name, value)
                        });
                        formData.append('di_id', {{$dangerous->id}})
                        
                        var resp = await post(url,formData)
                        // console.log(resp)
                            if(resp?.data?.status?.localeCompare('ok')==0){
                                $('#sampling-modal').modal('hide')
                                    this.table_sampling.ajax.reload()
                                

                            }else{
                                alert(resp?.data?.message)
                            }    
                        
                        break;
                
                    case 'delete': 
                        var url = `{{ route('backadmin.dangerous_samplings.delete', '__id') }}`
                        url = url.replace("__id", this.samplingModal?.item?.id)
                        var resp = await destroy(url)
                        // console.log(resp)
                        if(resp?.data?.status?.localeCompare('ok')==0){
                            $('#sampling-modal').modal('hide')
                                this.table_sampling.ajax.reload()

                        }else{
                            alert(resp?.data?.message)
                        }   
                        break;
                    
                    default:
                        break;
                }
                
            },
        }
    }).mount('#app');
</script>