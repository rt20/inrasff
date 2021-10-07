<script>

    let form = Vue.createApp({
        data() {
            return {
                downstream: {},
                availableTabs: [],
                activeTab: null,
                table_r : null,
                table_rw: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            downstream = {!! json_encode($downstream) !!};
            console.log(downstream)
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
                // console.log("origin source notif change")
                form.downstream.origin_source_notif = e.target.value
                form.downstream.source_notif = ''
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

            this.table_r = $('#table-permission-r').DataTable()

            this.table_rw = $('#table-permission-rw').DataTable()



        },
        computed: {

        },
        methods: {
            
        }
    }).mount('#app');
</script>