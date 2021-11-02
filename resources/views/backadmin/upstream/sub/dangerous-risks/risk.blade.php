<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Daftar Resiko</h4>
            @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
            <a href="{{ route('backadmin.risk_infos.create', ["notification_type" => "upstream", "notification_id" => $upstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
            @endif
        </div>
        <table id="table-risk" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Status Distribusi</th>
                    <th>Resiko Serius</th>
                    <th>Jumlah Korban</th>
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
    let url = "{{ route('backadmin.risk_infos.edit', '__id') }}";
    let icon = feather.icons['eye'].toSvg();
     $('#table-risk').DataTable({
            ajax:{
                url:"{{route('backadmin.risk_infos.index')}}",
                data: function(data) {
                    data.for_upstream = 1
                    data.ri_id = '{{$upstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'distribution_status.name' },
                {
                    defaultContent: '-' , 
                    data: 'serious_risk' 
                },
                { 
                    defaultContent: '-' ,
                    data: 'victim' 
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush