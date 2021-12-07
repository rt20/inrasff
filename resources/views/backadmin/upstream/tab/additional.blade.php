<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app-additional">
                <section class="bi-form-main">
                    @include('backadmin.upstream.sub.additionals.additional')
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
                upstream: {},
            }
        },
        created(){
            old = {!! json_encode(old()) !!};
            upstream = {!! json_encode($upstream) !!};
            
            this.upstream = {
                institution: old.institution ?? upstream.institution ?? '',
                contact_person: old.contact_person ?? upstream.contact_person ?? '',
                others: old.others ?? upstream.others ?? '',
            }
        }


    }).mount('#app-additional')
</script>

@endpush