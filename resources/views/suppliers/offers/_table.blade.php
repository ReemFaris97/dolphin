<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>البريد الالكترونى</th>
        <th>إسم المخزن</th>

        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $user)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$user->name!!}</td>
            <td>{!!$user->phone!!}</td>
            <td>{!!$user->email!!}</td>
            <td>{!!$user->store_name !!}</td>
            <td>
                <a href="{!!route('supplier.offers..edit',$user->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('supplier.offers.destroy',$user->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>


{{--                <form method="POST" action="{{route('distributor.clients.block',$user->id)}}">--}}
{{--                    @csrf() @method('patch')--}}
{{--                    @if($user->blocked_at==null)--}}
{{--                        <button type="submit" class="btn btn-warning">--}}
{{--                            <i class="fas fa-skull"></i>--}}
{{--                            حظر--}}
{{--                        </button>--}}
{{--                        <button type="submit" class="btn btn-warning"--}}
{{--                                onclick="if(!confirm('هل انت متاكد من حظر العميل')) event.preventDefault() ">--}}
{{--                            <i class="fas fa-skull"></i>--}}
{{--                            حظر--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <button type="submit" class="btn btn-success">--}}
{{--                            <i class="far fa-thumbs-up"></i>--}}
{{--                            تفعيل--}}
{{--                        </button>--}}
{{--                        <button type="submit" class="btn btn-success"--}}
{{--                                onclick="if(!confirm('هل انت متاكد من تفعيل العميل')) event.preventDefault() ">--}}
{{--                            <i class="far fa-thumbs-up"></i>--}}
{{--                            تفعيل--}}
{{--                        </button>--}}
{{--                    @endif--}}
{{--                </form>--}}
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
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
