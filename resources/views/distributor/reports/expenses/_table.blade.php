<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>

        <th>#</th>
        <th>   رقم سند المصروف</th>
        <th>اسم المندوب</th>
        <th>وقت وتاريخ المصروف</th>
        <th class="noExport">عمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td><a href="{{route('distributor.reports.expenses.show',$row->id) }}">{!!$row->sanad_No!!}</a></td>
            <td>{!!$row->distributor->name??'' !!}</td>
            <td>{!!$row-> date!!} {!!$row-> time!!}</td>
            <td><a href="{{route('distributor.reports.expenses.show',$row->id) }}" class="btn btn-success">عرض</a></td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
    <th>#</th>
        <th>   رقم سند المصروف</th>
        <th>اسم المندوب</th>
        <th>وقت وتاريخ المصروف</th>
        <th class="noExport">عمليات</th>
    </tr>
    </tfoot>
</table>
