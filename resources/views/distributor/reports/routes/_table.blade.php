<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th> كود العملية</th>
        <th>  اسم المسار</th>
        <th>  تاريخ بداية المسار</th>
        <th> الحالة</th>
        <th>اسم المندوب</th>
        <th>  عدد العملاء</th>
        <th> عدد المزار </th>
        <th> عدد الزيارات المقبولة </th>
        <th> عدد الزيارات المرفوضة </th>
        <th>  قيمة المصروفات </th>
        <th>    الصافى</th>
        <th class="noExport">عمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $row)
        <tr>
            <td> {!!$loop->iteration!!} </td>
            <td>{!!$row->name!!}</td>
            <td>{!!$row->created_at!!}</td>

            <td>{!!$row->is_finished==0? 'منتهى':'غيرمنتهى' !!}</td>
            <td>{!!$row->user->name !!}</td>
            <td>{!!$row->clients()!!}</td>
            <td>{!!$row->round!!}</td>
            <td>{!!$row->accepted_trips()!!}</td>
            <td>{!!$row->refused_trips()!!}</td>

            <td>{!!$row->trips_reports()->sum('expenses')!!}</td>
            <td>{!!$row->trips_reports()->sum('route_trip_reports.cash')-$row->trips_reports()->sum('expenses') !!}</td>



            <td><a href="{{route('distributor.reports.routes.show',$row->id) }}" class="btn btn-success">عرض</a></td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
            <th> كود العملية</th>
            <th>  اسم المسار</th>
            <th>  تاريخ بداية المسار</th>
            <th> الحالة</th>
            <th>اسم المندوب</th>
            <th>  عدد العملاء</th>
            <th> عدد المزار </th>
            <th> عدد الزيارات المقبولة </th>
            <th> عدد الزيارات المرفوضة </th>
            <th>  قيمة المصروفات </th>
            <th>    الصافى</th>
            <th class="noExport">عمليات</th>
    </tr>
    </tfoot>
</table>
