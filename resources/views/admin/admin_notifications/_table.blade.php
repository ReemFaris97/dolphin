<!--begin: Datatable -->



<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>العنوان</th>
        <th>التنبيه</th>
    </tr>
    </thead>
    <tbody>
    @foreach($admin_notifications as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->title!!}</td>
            <td>{!!$row->body!!}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>العنوان</th>
        <th>التنبيه</th>
    </tr>
    </tfoot>
</table>
