<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
        <tr>
            <th> # </th>
            <th> رقم سند المصروف</th>
            <th>اسم المندوب</th>
            <th>اسم البند</th>
            <th>نوع البند</th>
            <th>تاريخ الصرف</th>
            <th>اسم العداد</th>
            <th>قراءة العداد</th>
            <th>صوره العداد</th>
            <th>صوره فاتوره المصروف</th>
            <th>الاعدادت</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->sanad_No!!}</td>
            <td>{!!$row->distributor->name ??''!!}</td>
            <td>{!!$row->clause->name!!}</td>
            <td>{!!$row->type->name!!}</td>
            <td>{!!$row->date!!}</td>

            <td>
                @if($row->reader->name)
                {!! optional($row->reader)->name!!}
                @else
                لا يوجد عداد
                @endif
            </td>

            <td>
                @if($row->reader_number!=null)
                {!!$row->reader_number!!}
                @else
                لا يوجد عداد
                @endif
            </td>
            <td>
                @if($row->reader_image!=null)
                <img src="{!!asset($row->reader_image)!!}" height="100" width="100" />
                @else
                لا يوجد عداد
                @endif

            </td>


            <td>
                @if($row->image)
                <img src="{!!asset($row->image)!!}" height="100" width="100" />
                @else
                لا يوجد صوره للمصروف
                @endif

            </td>

            <td>
                <a href="{!!route('distributor.expenses.edit',$row->id)!!}" class="btn btn-primary"> <i
                        class="fas fa-pen"></i> تعديل</a>
                <a href="#" onclick="Delete({{$row->id}})" data-original-title="حذف"
                    class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.expenses.destroy',$row->id] ,'id'=>'delete-form'.$row->id,
                'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th> # </th>
            <th class="filter"> رقم سند المصروف</th>
            <th class="filter">اسم المندوب</th>
            <th class="filter">اسم البند</th>
            <th class="filter">نوع البند</th>
            <th class="filter">تاريخ الصرف</th>
            <th class="filter">اسم العداد</th>
            <th class="filter">قراءة العداد</th>
            <th>صوره العداد</th>
            <th>صوره فاتوره المصروف</th>
            <th>الاعدادت</th>
        </tr>
    </tfoot>
</table>
