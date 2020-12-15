<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم المرسل</th>
        <th>إسم المرسل اليه</th>

        <th>حالة التأكيد</th>
        <th>تاريخ العمليه</th>
        <th>نوع الحركه</th>
        <th>عدد المنتجات</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($storeTransfers as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!! optional($row->sender)->name !!}</td>
            <td>{!! optional($row->distributor)->name !!}</td>
            <td>
                @if($row->is_confirmed)
                    مؤكد
                    @else
                    غير مؤكد
                @endif
            </td>
            <td>{{optional($row->created_at)->format("Y-m-d h:m A")}}</td>
            <td>
                 نقل
            </td>
            <td>
                {{$row->products_count}}
            </td>
            <td>
               <a href="{!!route('distributor.storeTransfer.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>
{{--                <a href="{!!route('distributor.storeTransfer.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>--}}
{{--
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.storeTransfer.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>
