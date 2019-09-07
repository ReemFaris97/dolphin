<!--begin: Datatable -->



<table class="table table-striped- table-bordered table-hover table-checkable notiTable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
{{--        <th>رقم الإشعار</th>--}}
        <th>التنبيه</th>
    </tr>
    </thead>
    <tbody>
    @foreach(auth()->user()->notifications->pluck('data') as $notification)
        <tr>
            <td>{!!$loop->iteration!!}</td>
{{--            <td>{!! $notification['item_id'] !!}</td>--}}
            <td>{!! $notification['message'] !!}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
{{--        <th>#</th>--}}
{{--        <th>العنوان</th>--}}
        <th>التنبيه</th>
    </tr>
    </tfoot>
</table>
