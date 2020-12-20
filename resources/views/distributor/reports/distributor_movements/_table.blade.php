<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> الايراد </th>
        <th>  المصروف</th>
        <th>  العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td>{!!$row->InvoiceNumber!!}</td>
            <td>{!!$row->created_at!!}</td>
            <td>{!!$row->cash!!}</td>
            <td>{!!$row->expenses!!}</td>
            <td><a href="{{route('distributor.reports.distributor_movements.show',$row->id) }}">{!!$row->هي
!!}</a></td>


        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th> كود العملية</th>
        <th>تاريخ ووقت العملية</th>
        <th> الايراد </th>
        <th>  المصروف</th>
        <th>  العمليات</th>

    </tr>
    </tfoot>
</table>
