<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Tindak Lanjut</h4>
            {{-- <label for="table-risk" class="form-label ">Daftar Resiko</label> --}}
            @if($upstream->id !== null && in_array($upstream->status, ['open']))
            <a href="{{ route('backadmin.follow_ups.create', ["notification_type" => "upstream", "notification_id" => $upstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
            @endif
        </div>
        <table id="table-follow-up" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Penindak Lanjut</th>
                    <th>Lembaga / CCP</th>
                    <th>Tanggal Tindak Lanjut</th>
                    <th>Status</th>
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
    let url6 = "{{ route('backadmin.follow_ups.edit', '__id') }}";
    let icon6 = feather.icons['eye'].toSvg();
     $('#table-follow-up').DataTable({
            ajax:{
                url:"{{route('backadmin.follow_ups.index')}}",
                data: function(data) {
                    data.for_upstream = 1
                    data.bci_id = '{{$upstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'title' },
                { data: 'title' },
                { 
                    data: 'created_at',
                    render: function(data, type, row, meta) {
                        return moment(data).format('D MMMM YYYY HH:mm:ss')
                    } 
                },
                { 
                    data: 'status' ,
                    className: 'text-center',
                    render: function(data,type,row,meta){
                        return '<span class="badge badge-pill badge-light-' + row.status_class + ' px-1 py-50">' + row.status_label + '</span>'
                    }
                },             
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url6.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon6 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush