<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>اسم البند</th>
        <th>نوع البند</th>
        <th>تاريخ الصرف</th>
        <th>اسم العداد</th>
        <th>قراءة العداد</th>
        <th>صوره العداد</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>

            <td>{!!$row->clause->name!!}</td>
            <td>{!!$row->type->name!!}</td>
            <td>{!!$row->date!!}</td>
            <td>{!!$row->reader_name!!}</td>
            <td>{!!$row->reader_number!!}</td>
            <td><img src="{!!asset($row->reader_image)!!}" height="100" width="100"/></td>

            <td>
                <a href="{!!route('distributor.expenses.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('distributor.expenses.destroy',$row->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>اسم البند</th>
        <th>نوع البند</th>
        <th>تاريخ الصرف</th>
        <th>اسم العداد</th>
        <th>قراءة العداد</th>
        <th>صوره العداد</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
