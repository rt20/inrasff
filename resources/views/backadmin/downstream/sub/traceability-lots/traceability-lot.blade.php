<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Daftar Keterlusuran Lot</h4>
            {{-- <label for="table-risk" class="form-label ">Daftar Resiko</label> --}}
            @if($downstream->id !== null && !in_array($downstream->status, ['ccp process', 'ext process', 'done']))
            <a href="{{ route('backadmin.traceability_lot_infos.create', ["notification_type" => "downstream", "notification_id" => $downstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
            @endif
        </div>
        <table id="table-traceability-lot" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nomor Batch/Lot/Consignment</th>
                    <th>Negara Asal</th>
                    <th class="bi-table-col-action-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('page-js')
<script>
    let url3 = "{{ route('backadmin.risk_infos.edit', '__id') }}";
    let icon3 = feather.icons['eye'].toSvg();
     $('#table-traceability-lot').DataTable({
            ajax:{
                url:"{{route('backadmin.traceability_lot_infos.index')}}",
                data: function(data) {
                    data.for_downstream = 1
                    data.ri_id = '{{$downstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'number' },
                { data: 'source_country_id' },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url3.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon3 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush