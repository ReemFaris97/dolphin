<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($notifications_category as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->name!!}</td>
            <td><a href="{!!route('admin.notifications-category.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('admin.notifications-category.destroy',$row->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>
                {{--<form method="POST" action="{!!route('admin.notifications-category.block',$row->id)!!}">--}}
                    {{--@csrf() @method('patch')--}}
                    {{--@if($row->blocked_at==null)--}}
                        {{--<button type="submit" class="btn btn-warning">--}}
                            {{--<i class="fas fa-skull"></i>--}}
                            {{--حظر--}}
                        {{--</button>--}}
                    {{--@else--}}
                        {{--<button type="submit" class="btn btn-success">--}}
                            {{--<i class="fas fa-skull"></i>--}}
                            {{--الغاء الحظر--}}
                        {{--</button>--}}
                    {{--@endif--}}
                {{--</form>--}}
            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
