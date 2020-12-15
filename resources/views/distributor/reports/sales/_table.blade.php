<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td><a href="{{route('distributor.reports.client_report.show',$row->id) }}">{!!$row->invoice_number!!}</a></td>
            <td>{!!$row->created_at!!}</td>
            <td>{!!$row->amount!!}</td>


        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> قيمة العملية</th>
    </tr>
    </tfoot>
</table>
