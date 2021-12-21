<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th >الاسم</th>
        <th >مصدر الصرف</th>
        <th >نوع المصروف</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenditureClauses as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->name!!}</td>
            <td>{!!$row?->type?'من المورد':'من المندوب'!!}</td>
            <td>{!!$row?->payable?->name!!}</td>
            <td>
                @if ($row->is_active==0)
                    <a href="{{route("distributor.expenditureClauses.active",$row->id)}}" class="btn btn-success circle" title="تفعيل">
                        <i class="fas fa-check"></i> تفعيل
                    </a>
                @else
                    <a href="{{route("distributor.expenditureClauses.dis_active",$row->id)}}" class="btn btn-danger" title="الغاء تفعيل">
                        <i class="fas fa-times"></i>
                        الغاء تفعيل
                    </a>
                @endif
                <a href="{!!route('distributor.expenditureClauses.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.expenditureClauses.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th class="filter">الاسم</th>
        <th  class="filter">نوع المصروف</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
