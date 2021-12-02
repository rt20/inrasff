<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Role</th>
            <th>User</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($approvals as $approval)
        <tr>
            <td>{{ $approval->role->name }}</td>
            <td>{{ $approval->user ? $approval->user->fullname : '-' }}</td>
            <td>{{ $approval->approved_at ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>