<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>

        <th>#</th>
        <th>اسم  المخزن </th>
        <th>اسم المندوب</th>
        <th>وقت وتاريخ التسجيل</th>
        <th class="noExport">عمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($damages as $row)
        <tr>
            <td> {!!$loop->iteration!!}</td>
            <td>{!!$row->store->name??'' !!}</td>
            <td>{!!$row->distributor->name??'' !!}</td>
            <td>{!!$row->created_at!!}</td>
            <td><a href="{{route('distributor.reports.damages.show',$row->id) }}" class="btn btn-success">عرض</a></td>

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
