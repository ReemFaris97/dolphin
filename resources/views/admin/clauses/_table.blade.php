<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>اسم المسؤول</th>
        <th>الكمية</th>
        <th>الكمية الإفتراضية</th>
        <th>الحالة</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clauses as $row)

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->name!!}</td>
            <td>{!!optional($row->user)->name!!}</td>
            <td>{!!$row->amount!!}</td>
            <td>{!!$row->default_amount !!}</td>
            <td>
                @if($row->blocked_at==null)
                    مفعل
                    @else
                    غير مفعل
                    @endif
            </td>

            <td>
                <a href="{!!route('admin.clauses.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-allergies"></i>
                    تفاصيل</a>
                <a href="{!!route('admin.clauses.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i>
                    تعديل</a>
                <form method="POST" action="{!!route('admin.clauses.destroy',$row->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger"
                            onclick="if(!confirm('هل انت متاكد من حذف البند')) event.preventDefault() ">

                    <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>



                <form method="POST" action="{!!route('admin.clauses.block',$row->id)!!}">
                    @csrf() @method('patch')
                    @if($row->blocked_at==null)
                        {{--<button type="submit" class="btn btn-warning">--}}
                        {{--<i class="fas fa-skull"></i>--}}
                        {{--حظر--}}
                        {{--</button>--}}
                        <button type="submit" class="btn btn-warning"
                                onclick="if(!confirm('هل انت متاكد من حظر البند')) event.preventDefault() ">
                            <i class="fas fa-skull"></i>
                            حظر
                        </button>
                    @else
                        {{--<button type="submit" class="btn btn-success">--}}
                        {{--<i class="far fa-thumbs-up"></i>--}}
                        {{--تفعيل--}}
                        {{--</button>--}}
                        <button type="submit" class="btn btn-success"
                                onclick="if(!confirm('هل انت متاكد من تفعيل البند')) event.preventDefault() ">
                            <i class="far fa-thumbs-up"></i>
                            تفعيل
                        </button>
                    @endif
                </form>

            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>اسم المسؤول</th>
        <th>الكمية</th>
        <th>الكمية الإفتراضية</th>
        <th>الحالة</th>
        <th class="noExport">الاعدادت</th>
    </tfoot>
</table>
