
<script>


    let form = Vue.createApp({
        data() {
            return {
                risk: {},
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            risk = {!! json_encode($risk) !!};
            console.log(risk)
            this.risk = {
                distribution_status_id: old.distribution_status_id ?? risk.distribution_status_id ?? '',
                serious_risk: old.serious_risk ?? risk.serious_risk ?? '',
                victim: old.victim ?? risk.victim ?? '',
                symptom: old.symptom ?? risk.symptom ?? ''   ,
                voluntary_measures: old.voluntary_measures ?? risk.voluntary_measures ?? ''   ,            
                add_voluntary_measures: old.add_voluntary_measures ?? risk.add_voluntary_measures ?? ''   ,            

                compulsory_measures: old.compulsory_measures ?? risk.compulsory_measures ?? ''   ,            
                add_compulsory_measures: old.add_compulsory_measures ?? risk.add_compulsory_measures ?? ''   ,            
                
            }

            console.log(this.risk)
            if(this.risk.distribution_status_id !== ''){
                initS2FieldWithAjax(
                    '#distribution_status_id',
                    '{{route("backadmin.s2Init.distribution_status")}}',
                    {id:this.risk.distribution_status_id},
                    ['name']
                )
            }

            /**
             * Rule for Measure
            */
            this.risk.voluntary_measures_type = ""
            if(this.risk.add_voluntary_measures !== ''){
                if(['physical treatment', 'product to-be'].includes(this.risk.voluntary_measures)){
                    this.risk.voluntary_measures_type = "select"
                }else{
                    this.risk.voluntary_measures_type = "input"
                }
            }
            
            this.risk.compulsory_measures_type = ""
            if(this.risk.add_compulsory_measures !== ''){
                if(['physical treatment', 'product to-be'].includes(this.risk.compulsory_measures)){
                    this.risk.compulsory_measures_type = "select"
                }else{
                    this.risk.compulsory_measures_type = "input"
                }
            }
        },
        mounted() {
            $('.select2').select2();
            
            this.initiateS2(
                "#distribution_status_id",
                "{{route('backadmin.s2Opt.distribution_status')}}",
                0,
                "Silahkan Pilih Status Distribusi",
                ['name'],
                function(e){
                    form.risk.category_id = e.target.value
                }
            )

            $('select[name="voluntary_measures"]').on('change', function(e){
                form.risk.voluntary_measures = e.target.value
                form.risk.add_voluntary_measures = ''
                form.risk.voluntary_measures_type = $(this).find(':selected').data('add-form') ?? ''
                // console.log($(this).find(':selected').data('add-form'))
            })

            $('select[name="add_voluntary_measures"]').on('change', function(e){
                form.risk.add_voluntary_measures = e.target.value
            })

            $('select[name="compulsory_measures"]').on('change', function(e){
                form.risk.compulsory_measures = e.target.value
                form.risk.add_compulsory_measures = ''
                form.risk.compulsory_measures_type = $(this).find(':selected').data('add-form') ?? ''
                // console.log($(this).find(':selected').data('add-form'))
            })

            $('select[name="add_compulsory_measures"]').on('change', function(e){
                form.risk.add_compulsory_measures = e.target.value
            })

            
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
                return initiateS2(
                    elId,
                    url,
                    minimumInputLength,
                    placeholder,
                    attrs,
                    onSelect
                ) 
            }
        }
    }).mount('#app');
</script>