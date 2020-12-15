<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>الصوره</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>البريد الالكترونى</th>
        <th>المورد التابع له</th>
{{--        <th>الجنسية</th>--}}
{{--        <th> اسم الشركه</th>--}}
{{--        <th> النوع</th>--}}
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employes as $user)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td><img src="{!!asset($user->image)!!}" height="100" width="100"/></td>
            <td>{!!$user->name!!}</td>
            <td>{!!$user->phone!!}</td>
            <td>{!!$user->email!!}</td>

            {{--<td>{!!$user-> parent->name!!}</td>--}}
{{--            <td>{!! chooseNationality($user->nationality)!!}</td>--}}
{{--            <td>{!!$user->company_name!!}</td>--}}
{{--            <td>{!!$user->type!!}</td>--}}

            <td>

                <a href="{!!route('supplier.employes.edit',$user->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>


{{--                --}}
                <form method="POST" action="{!!route('supplier.employes.destroy',$user->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>


                <form method="POST" action="{{route('supplier.suppliers.block',$user->id)}}">
                    @csrf() @method('patch')
                    @if($user->blocked_at==null)
                        <button type="submit" class="btn btn-warning"
                                onclick="if(!confirm('هل انت متاكد من حظر العضو')) event.preventDefault() ">
                            <i class="fas fa-skull"></i>
                            حظر
                        </button>
                    @else
{{--                        <button type="submit" class="btn btn-success">--}}
{{--                            <i class="far fa-thumbs-up"></i>--}}
{{--                            تفعيل--}}
{{--                        </button>--}}
                        <button type="submit" class="btn btn-success"
                                onclick="if(!confirm('هل انت متاكد من تفعيل العضو')) event.preventDefault() ">
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
        <th>الصوره</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>البريد الالكترونى</th>
{{--        <th>الوظيفه</th>--}}
{{--        <th>الجنسية</th>--}}
{{--        <th> اسم الشركه</th>--}}
{{--        <th> النوع</th>--}}
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
