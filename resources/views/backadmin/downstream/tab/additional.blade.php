<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app-additional">
                <section class="bi-form-main">
                    @include('backadmin.downstream.sub.additionals.additional')
                </section>
            </div>
        </div>
    </div>
</div>
@push('page-js')
<script>
    let form_additional = Vue.createApp({
        data() {
            return {
                downstream: {},
            }
        },
        created(){
            old = {!! json_encode(old()) !!};
            downstream = {!! json_encode($downstream) !!};
            
            this.downstream = {
                institution: old.institution ?? downstream.institution ?? '',
                contact_person: old.contact_person ?? downstream.contact_person ?? '',
                others: old.others ?? downstream.others ?? '',
            }
        }


    }).mount('#app-additional')
</script>

@endpush