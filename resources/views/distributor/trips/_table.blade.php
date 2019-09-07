<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>اسم المسار</th>
        <th>العنوان </th>
        <th> الترتيب</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trips as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->route->name!!}</td>
            <td>{!!$row->address!!}</td>
            <td>{!!$row->arrange!!}</td>

            <td>
                <a href="{!!route('distributor.trips.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('distributor.trips.destroy',$row->id)!!}">
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
        <th>الاسم</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
