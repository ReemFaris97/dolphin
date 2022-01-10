<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th> كود العملية</th>
        <th>  اسم المسار</th>
        <th>اسم المندوب</th>
        <th>  تاريخ بداية المسار</th>
        <th>  تاريخ انتهاء المسار</th>
        <th> الحالة</th>
        <th>  عدد العملاء</th>
        <th> عدد المزار </th>
        <th> عدد الزيارات المقبولة </th>
        <th> عدد الزيارات المرفوضة </th>
        {{-- <th>  قيمة المصروفات </th> --}}
        <th>    الصافى</th>
        <th class="noExport">عمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $row)
        <tr>
            <td> {!!$loop->iteration!!} </td>
            <td>{!!$row->name!!}</td>
            <td>{!!$row->user_name !!}</td>
            <td>{!!$row->start_at!!}</td>
            <td>{!!$row->end_at!!}</td>
            <td>{!!$row->finish_report_id!=null? 'منتهى':'غيرمنتهى' !!}</td>
            <td>{!!$row->trip_counts!!}</td>
            <td>{!!$row->trip_invertory_count!!}</td>
            <td>{!!$row->accept_count!!}</td>
            <td>{!!$row->refuse_count!!}</td>

            {{-- <td>{!!$row->trips_reports()->sum('expenses')!!}</td> --}}
            <td>{!!$row->total_money !!}</td>



            <td>{{-- <a href="{{route('distributor.reports.routes.show',$row->dr_id) }}" class="btn btn-success">عرض</a> --}}</td>

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
