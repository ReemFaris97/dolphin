<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم المرسل</th>
        <th>إسم المرسل اليه</th>
        <th>المبلغ</th>
        <th>التاريخ</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!! optional($row->sender)->name  !!}</td>
            <td>{!!optional( $row->receiver)->name !!}</td>
            <td>{!! $row->amount !!}</td>
            <td>{!! $row->created_at !!}</td>

            <td>
{{--                <a href="{!!route('distributor.transactions.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>--}}
                <a href="{!!route('distributor.transactions.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash-o"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.transactions.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>الاسم</th>--}}
{{--        <th>الاعدادت</th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
</table>
