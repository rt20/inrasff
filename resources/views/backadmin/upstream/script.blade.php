<script>
    function setSectionForm(section = "general"){
        $('#section-form').val(section)
    }
    let form = Vue.createApp({
        data() {
            return {
                upstream: {},
                availableTabs: [],
                activeTab: null,
                
            }
        },
        created() {
            // console.log("general")
            old = {!! json_encode(old()) !!};
            upstream = {!! json_encode($upstream) !!};
            // console.log(upstream)
            this.upstream = {
                id: upstream.id ?? '',
                title: old.title ?? upstream.title ?? '',
                number_ref: old.number_ref ?? upstream.number_ref ?? '',
                status_notif_id: old.status_notif_id ?? upstream.status_notif_id ?? '',
                type_notif_id: old.type_notif_id ?? upstream.type_notif_id ?? '',
                country_id: old.country_id ?? upstream.country_id ?? '',
                based_notif_id: old.based_notif_id ?? upstream.based_notif_id ?? '',
                origin_source_notif: old.origin_source_notif ?? upstream.origin_source_notif ?? '',
                source_notif: old.source_notif ?? upstream.source_notif ?? '',
                date_notif: old.date_notif ?? upstream.date_notif ?? '',

                product_name: old.product_name ?? upstream.product_name ?? '',
                category_product_id: old.category_product_id ?? upstream.category_product_id ?? '',
                brand_name: old.brand_name ?? upstream.brand_name ?? '',
                registration_number: old.registration_number ?? upstream.registration_number ?? '',
                package_product: old.package_product ?? upstream.package_product ?? '',
            }

            if(this.upstream.country_id !== ''){
                initS2FieldWithAjax(
                    '#country_id',
                    '{{route("backadmin.s2Init.countries")}}',
                    {id:this.upstream.country_id},
                    ['code', 'name']
                )
            }

            if(this.upstream.status_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_status_notif_id',
                    '{{route("backadmin.s2Init.notification_status")}}',
                    {id:this.upstream.status_notif_id},
                    ['name']
                )
            }

            if(this.upstream.type_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_type_notif_id',
                    '{{route("backadmin.s2Init.notification_type")}}',
                    {id:this.upstream.type_notif_id},
                    ['name']
                )
            }

            if(this.upstream.based_notif_id !== ''){
                initS2FieldWithAjax(
                    '#f_based_notif_id',
                    '{{route("backadmin.s2Init.notification_base")}}',
                    {id:this.upstream.based_notif_id},
                    ['name']
                )
            }
            
        },
        mounted() {
            $('.date').flatpickr();
            $('.select2').select2();

            $('select[name="origin_source_notif"]').on('change', function(e){
                form.upstream.origin_source_notif = e.target.value
                console.log(form.upstream)
            })

            $('select[name="source_notif"]').on('change', function(e){
                form.upstream.source_notif = e.target.value
            })

            $('select[name="category_product_id"').on('change', function(e){
                form.upstream.category_product_id = e.target.value
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
                form.upstream.country_id = e.target.value
            })
            
            this.initiateS2(
                '#f_status_notif_id',
                "{{ route('backadmin.s2Opt.notification_status') }}",
                0,
                "Silahkan pilih status notifikasi",
                ['name'],
                function(e){
                    form.upstream.status_notif_id = e.target.value
                }
            )

            this.initiateS2(
                '#f_type_notif_id',
                "{{ route('backadmin.s2Opt.notification_type') }}",
                0,
                "Silahkan pilih tipe notifikasi",
                ['name'],
                function(e){
                    form.upstream.type_notif_id = e.target.value
                }
            )

            this.initiateS2(
                '#f_based_notif_id',
                "{{ route('backadmin.s2Opt.notification_base') }}",
                0,
                "Silahkan pilih dasar notifikasi",
                ['name'],
                function(e){
                    form.upstream.based_notif_id = e.target.value
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
                    // form.upstream.country_id = e.target.value
                    if(onSelect)
                        onSelect(e)
                })
            }
        }
    }).mount('#app');
</script>