<script>
    let form_dangerous_risk = Vue.createApp({
        data() {
            return {
                dangerous_risk : {},
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
                        title: 'sampling_qty',
                        name : 'sampling_qty',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                    {
                        title: 'sampling_method',
                        name : 'sampling_method',
                        input: 'input',
                        required: true,
                        parse: null
                    },

                    {
                        title: 'sampling_place',
                        name : 'sampling_place',
                        input: 'input',
                        required: true,
                        parse: null
                    },
                ],
            }
        },
        created(){
            console.log("dangerous risk")
            old = {!! json_encode(old()) !!}
            dangerous_risk = {!! json_encode($downstream->dangerousRisk) !!}
            console.log(dangerous_risk)
            this.dangerous_risk = {
                name_dangerous: old.name_dangerous ?? dangerous_risk.name_dangerous ?? '',
                category_dangerous: old.category_dangerous ?? dangerous_risk.category_dangerous ?? '',
                name_result: old.name_result ?? dangerous_risk.name_result ?? '',
                uom_result: old.uom_result ?? dangerous_risk.uom_result ?? '',
                laboratorium: old.laboratorium ?? dangerous_risk.laboratorium ?? '',
                matrix: old.matrix ?? dangerous_risk.matrix ?? '',
                scope: old.scope ?? dangerous_risk.scope ?? '',
                max_tollerance: old.max_tollerance ?? dangerous_risk.max_tollerance ?? '',
                distribution_status: old.distribution_status ?? dangerous_risk.distribution_status ?? '',
                serious_risk: old.serious_risk ?? dangerous_risk.serious_risk ?? '',
                victim: old.victim ?? dangerous_risk.victim ?? '',
                symptom: old.symptom ?? dangerous_risk.symptom ?? ''
            }
        },
        mounted(){
            // $('.date').flatpickr();
            $('.select2-dr').select2();

            this.table_sampling = $('#table-sampling').DataTable()
        }
    }).mount("#app-dangerous-risk")
</script>