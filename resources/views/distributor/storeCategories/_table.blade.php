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
    @foreach($categories as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$row->name!!}</td>
            <td>
                <a href="{!!route('distributor.store_categories.edit',$row->id)!!}" class="btn btn-primary"> <i
                        class="fas fa-pen"></i> تعديل</a>
                <a href="#" onclick="Delete({{$row->id}})" data-original-title="حذف"
                   class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.store_categories.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
                <form method="POST" action="{{route('distributor.store_categories.block',$row->id)}}">
                    @csrf() @method('patch')

                    @if($row->blocked_at==null)
                        {{--                        <button type="submit" class="btn btn-warning">--}}
                        {{--                            <i class="fas fa-skull"></i>--}}
                        {{--                            حظر--}}
                        {{--                        </button>--}}
                        <button type="submit" class="btn btn-warning"
                                onclick="if(!confirm('هل انت متاكد من الغاء تفعيل النوع')) event.preventDefault() ">
                            <i class="fas fa-skull"></i>
                            الغاء تفعيل
                        </button>
                    @else
                        {{--                        <button type="submit" class="btn btn-success">--}}
                        {{--                            <i class="far fa-thumbs-up"></i>--}}
                        {{--                            تفعيل--}}
                        {{--                        </button>--}}
                        <button type="submit" class="btn btn-success"
                                onclick="if(!confirm('هل انت متاكد من تفعيل النوع')) event.preventDefault() ">
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
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
