<script>
    function openDistributionModal(state, id=null, item = {id:null}){
        
        form.openDistributionModal(state, id, item)        
    }

    let form = Vue.createApp({
        data() {
            return {
                traceability_lot: {},
                table_distribution : null,
                distributionModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                    },
                    error: ''
                },
                validatorDistribution : [
                    {
                        title: 'distribution_country',
                        name : 'distribution_country',
                        input: 'select',
                        required: true,
                        parse: null
                    },
                ],
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            console.log(old)
            traceability_lot = {!! json_encode($traceability_lot) !!};
            console.log(traceability_lot)
            this.traceability_lot = {
                source_country_id: old.source_country_id ?? traceability_lot.source_country_id ?? '',
                number: old.number ?? traceability_lot.number ?? '',
                used_by: old.used_by ?? traceability_lot.used_by ?? '',
                best_before: old.best_before ?? traceability_lot.best_before ?? ''  ,             
                sell_by: old.sell_by ?? traceability_lot.sell_by ?? '' ,
                number_unit: old.number_unit ?? traceability_lot.number_unit ?? ''    ,           
                net_weight: old.net_weight ?? traceability_lot.net_weight ?? '',       
                cert_number: old.cert_number ?? traceability_lot.cert_number ?? '',         
                cert_date: old.cert_date ?? traceability_lot.cert_date ?? '',  
                cert_institution: old.cert_institution ?? traceability_lot.cert_institution ?? '', 
                add_cert_number: old.add_cert_number ?? traceability_lot.add_cert_number ?? ''    ,           
                add_cert_date: old.add_cert_date ?? traceability_lot.add_cert_date ?? ''           ,    
                add_cert_institution: old.add_cert_institution ?? traceability_lot.add_cert_institution ?? '' ,

                producer_name: old.producer_name ?? traceability_lot.producer_name ?? '' ,
                producer_address: old.producer_address ?? traceability_lot.producer_address ?? '' ,
                producer_city: old.producer_city ?? traceability_lot.producer_city ?? '' ,
                producer_country_id: old.producer_country_id ?? traceability_lot.producer_country_id ?? '' ,
                producer_approval: old.producer_approval ?? traceability_lot.producer_approval ?? '' ,
                
                importer_name: old.importer_name ?? traceability_lot.importer_name ?? '' ,
                importer_address: old.importer_address ?? traceability_lot.importer_address ?? '' ,
                importer_city: old.importer_city ?? traceability_lot.importer_city ?? '' ,
                importer_country_id: old.importer_country_id ?? traceability_lot.importer_country_id ?? '' ,
                importer_approval: old.importer_approval ?? traceability_lot.importer_approval ?? '' ,

                wholesaler_name: old.wholesaler_name ?? traceability_lot.wholesaler_name ?? '' ,
                wholesaler_address: old.wholesaler_address ?? traceability_lot.wholesaler_address ?? '' ,
                wholesaler_city: old.wholesaler_city ?? traceability_lot.wholesaler_city ?? '' ,
                wholesaler_country_id: old.wholesaler_country_id ?? traceability_lot.wholesaler_country_id ?? '' ,
                wholesaler_approval: old.wholesaler_approval ?? traceability_lot.wholesaler_approval ?? '' ,
            }

            if(this.traceability_lot.source_country_id !== ''){
                initS2FieldWithAjax(
                    '#source_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.traceability_lot.source_country_id},
                    ['code', 'name']
                )
            }

            if(this.traceability_lot.producer_country_id !== ''){
                initS2FieldWithAjax(
                    '#producer_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.traceability_lot.producer_country_id},
                    ['code', 'name']
                )
            }

            if(this.traceability_lot.importer_country_id !== ''){
                initS2FieldWithAjax(
                    '#importer_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.traceability_lot.importer_country_id},
                    ['code', 'name']
                )
            }

            if(this.traceability_lot.wholesaler_country_id !== ''){
                initS2FieldWithAjax(
                    '#wholesaler_country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.traceability_lot.wholesaler_country_id},
                    ['code', 'name']
                )
            }

            console.log(this.traceability_lot)
        },
        mounted() {
            $('.date').flatpickr();
            $('#source_country_id').select2({
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
                placeholder: 'Masukkan Negara Asal',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.traceability_lot.source_country_id = e.target.value
            })

            $('#producer_country_id').select2({
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
                placeholder: 'Masukkan Negara Produsen',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.traceability_lot.producer_country_id = e.target.value
            })

            $('#importer_country_id').select2({
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
                placeholder: 'Masukkan Negara Importir',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.traceability_lot.importer_country_id = e.target.value
            })

            $('#wholesaler_country_id').select2({
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
                placeholder: 'Masukkan Negara Wholesaler',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            }).on('select2:select', function(e){
                form.traceability_lot.wholesaler_country_id = e.target.value
            })

            $('#distribution_country').select2({
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
                placeholder: 'Masukkan Negara Terdistribusi',
                templateResult:function(data){
                    return data.loading ? 'Mencari...' : data.code + ' - ' +data.name; 
                },
                templateSelection: function(data) {
                    return data.text || data.code + ' - ' + data.name;
                }

            })

            let icon = feather.icons['trash'].toSvg();
            this.table_distribution = $('#table-distribution').DataTable({
                ajax:{
                    url:"{{route('backadmin.traceability_lot_distributions.index')}}",
                    data: function(data) {
                        data.tl_id = '{{$traceability_lot->id}}'
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { 
                        data: 'country.name',
                        defaultContent: '-'
                    },
                    @if($traceability_lot->id)
                    @if(in_array($traceability_lot->notification->status, ['open', 'draft']))
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false, 
                        render: function(data, type, row, meta) {
                            return `<a href="#" onclick="openDistributionModal('delete', `+data+`)"  class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                        } 
                    }
                    @endif
                    @endif
                ],
                order: [[0, 'desc']],
                language: dtLangId
            })
        },
        computed: {

        },
        methods: {
            slugify(text){
                return slugify(text)
            },
            openDistributionModal(state, id=null, item = {id:null}){
                // console.log("Halo")

                $('#distribution-modal-form').trigger('reset')
                $('#distribution_country').val(null).trigger('change')
                $('.text-warn').remove();
                this.distributionModal.state = state;
                switch (this.distributionModal.state) {
                    case 'add':                    
                        this.distributionModal.item = item;                        
                        break;
                    case 'delete':
                        // this.distributionModal.item = Object.assign({}, this.slider.slider_image[index]);
                        this.distributionModal.item = {id:id};   
                        break;
                    
                    default:
                        break;
                }
                $('#distribution-modal').modal({ backdrop: 'static', keyboard: false })
            },
            async submitItem(e){
                e.preventDefault()
                $('.text-warn').remove();
                let invalid;

                switch (this.distributionModal.state) {
                    case 'add':
                        this.validatorDistribution.forEach(el => {
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

                        var url = `{{ route('backadmin.traceability_lot_distributions.add') }}`
                        var formData = new FormData()
                        formData.append('tl_id', {{$traceability_lot->id}})
                        formData.append('country_id', $('#distribution_country').val())
                        
                        var resp = await post(url,formData)
                        // console.log(resp)
                            if(resp?.data?.status?.localeCompare('ok')==0){
                                $('#distribution-modal').modal('hide')
                                    this.table_distribution.ajax.reload()
                                

                            }else{
                                alert(resp?.data?.message)
                            }    
                        
                        break;
                
                    case 'delete': 
                        var url = `{{ route('backadmin.traceability_lot_distributions.delete', '__id') }}`
                        url = url.replace("__id", this.distributionModal?.item?.id)
                        var resp = await destroy(url)
                        // console.log(resp)
                        if(resp?.data?.status?.localeCompare('ok')==0){
                            $('#distribution-modal').modal('hide')
                                this.table_distribution.ajax.reload()

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
<script>
    $(document).ready(function(){
        console.log('ready log section form')
        @if(isset($traceability_lot->notification))
        @if(!in_array($traceability_lot->notification->status, ['open', 'draft']))
            $('.bi-form-main input, .bi-form-main select, .bi-form-main textarea').prop('disabled', true);
            $('.bi-form-main input').removeClass('read-only-white')
            $('.dataTables_wrapper input, .dataTables_wrapper select').prop('disabled', false)
        @endif
        @endif
    })
</script>