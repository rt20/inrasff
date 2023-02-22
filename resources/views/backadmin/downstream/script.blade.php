<script>
    function setSectionForm(section = "general"){
        $('#section-form').val(section)
    }
    let form = Vue.createApp({
        data() {
            return {
                downstream: {},
                availableTabs: [],
                activeTab: null,
                local_id:`{{ Helper::localCountry() }}`,                
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            downstream = {!! json_encode($downstream) !!};
            this.downstream = {
                id: downstream.id ?? '',
                title: old.title ?? downstream.title ?? '',
                // number_ref: old.number_ref ?? downstream.number_ref ?? '',
                status_notif_id: old.status_notif_id ?? downstream.status_notif_id ?? '',
                type_notif_id: old.type_notif_id ?? downstream.type_notif_id ?? '',
                country_id: old.country_id ?? downstream.country_id ?? '',
                based_notif_id: old.based_notif_id ?? downstream.based_notif_id ?? '',
                origin_source_notif: old.origin_source_notif ?? downstream.origin_source_notif ?? '',
                source_notif: old.source_notif ?? downstream.source_notif ?? '',
                date_notif: old.date_notif ?? downstream.date_notif ?? '',

                product_name: old.product_name ?? downstream.product_name ?? '',
                category_product_id: old.category_product_id ?? downstream.category_product_id ?? '',
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

            if(this.downstream.status_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_status_notif_id',
                    '{{route("backadmin.s2Init.notification_status")}}',
                    {id:this.downstream.status_notif_id},
                    ['name']
                )
            }

            if(this.downstream.type_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_type_notif_id',
                    '{{route("backadmin.s2Init.notification_type")}}',
                    {id:this.downstream.type_notif_id},
                    ['name']
                )
            }

            if(this.downstream.based_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_based_notif_id',
                    '{{route("backadmin.s2Init.notification_base")}}',
                    {id:this.downstream.based_notif_id},
                    ['name']
                )
            }
            
        },
        mounted() {
            $('.date').flatpickr();
            $('.select2').select2();

            $('select[name="origin_source_notif"]').on('change', function(e){
                form.downstream.origin_source_notif = e.target.value
                $('#country_id').val(null).trigger('change')
                $('select[name="source_notif"]').val(null).trigger('change')
                if(e.target.value==='local'){
                    /*
                    Auto Select Indonesia for Local Case
                    */
                    initS2FieldWithAjax(
                        '#country_id',
                        '{{route("backadmin.s2Init.countries")}}',
                        // {id:76},
                        {id: form.local_id},
                        ['code', 'name'],
                        function(res){
                            // form.downstream.country_id = 76
                            form.downstream.country_id = form.local_id
                            console.log(form.downstream)
                        }
                    )
                }
                // console.log(form.downstream)
            })

            $('select[name="source_notif"]').on('change', function(e){
                form.downstream.source_notif = e.target.value
            })

            $('select[name="category_product_id"').on('change', function(e){
                form.downstream.category_product_id = e.target.value
            })

            $('#country_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.countries') }}",
                    data: function(params){
                        let req = {
                            q:params.term,
                            local: $('select[name="origin_source_notif"]').val() === 'local' ? 1 :0
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
            
            this.initiateS2(
                '#f_status_notif_id',
                "{{ route('backadmin.s2Opt.notification_status') }}",
                0,
                "Silahkan pilih status notifikasi",
                ['name'],
                function(e){
                    form.downstream.status_notif_id = e.target.value
                }
            )

            this.initiateS2(
                '#f_type_notif_id',
                "{{ route('backadmin.s2Opt.notification_type') }}",
                0,
                "Silahkan pilih tipe notifikasi",
                ['name'],
                function(e){
                    form.downstream.type_notif_id = e.target.value
                }
            )

            this.initiateS2(
                '#f_based_notif_id',
                "{{ route('backadmin.s2Opt.notification_base') }}",
                0,
                "Silahkan pilih dasar notifikasi",
                ['name'],
                function(e){
                    form.downstream.based_notif_id = e.target.value
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
                onSelect
            ){
                $(elId).select2({
                ajax: {
                        url: url,
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
                minimumInputLength: minimumInputLength,
                placeholder: placeholder,
                templateResult:function(data){
                    var text = "";
                    for (let i = 0; i < attrs.length; i++) {
                        text += data[attrs[i]]              
                        
                        if(i != attrs.length - 1){
                            text += " - "
                        }
                    }
                    return data.loading ? 'Mencari...' : text 
                },
                templateSelection: function(data) {
                        var text = "";
                        for (let i = 0; i < attrs.length; i++) {
                            text += data[attrs[i]]              
                            
                            if(i != attrs.length - 1){
                                text += " - "
                            }
                        }
                        return data.text || text;
                    }

                }).on('select2:select', function(e){
                    // form.downstream.country_id = e.target.value
                    if(onSelect)
                        onSelect(e)
                })
            }
        }
    }).mount('#app');
</script>