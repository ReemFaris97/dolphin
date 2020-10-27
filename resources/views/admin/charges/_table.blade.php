<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>إسم العهدة</th>
        <th>الموظف المسند اليه العهدة</th>
        <th>الموظف</th>
        <th>تاريخ الإسناد</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($charges as $charge)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$charge->name!!}</td>
            <td>{!!optional($charge->worker)->name!!}</td>
            <td>{!!optional($charge->supervisor)->name!!}</td>
            <td>{!! $charge->created_at !!}</td>
            <td>

                <a href="{!!route('admin.charges.show',$charge->id)!!}" class="btn btn-warning"> <i class="fas fa-allergies"></i>
                    تفاصيل</a>

                @if($charge->destroyed_at == null)
                @if(auth()->user()->hasPermissionTo('edit_charges'))
                <a href="{!!route('admin.charges.edit',$charge->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i>
                    تعديل</a>
                @endif
                @endif

                @if(auth()->user()->hasPermissionTo('delete_charges'))
                <form method="POST" action="{!!route('admin.charges.destroy',$charge->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="if(!confirm('هل انت متاكد من حذف العهده')) event.preventDefault() ">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>
                @endif

                @if($charge->destroyed_at == null)

                    @if(auth()->user()->hasPermissionTo('destroy_charges'))
                    <a href="javascript:" id="destruct{{$charge->id}}" data-id="{{$charge->id}}" data-url="{!!route('admin.charges.destruct',$charge->id)!!}" class="destruct btn btn-danger"> <i class="fas fa-allergies"></i>
                        إتلاف</a>
                        
                        
                        
                    @endif

                @endif


                @if($charge->confirmed_at == null && $charge->supervisor_id == auth()->id())
  <a id="elementRow{{$charge->id}}" href="javascript:" data-id="{{$charge->id}}" data-url="{{route('admin.charges.confirm')}}" class="statusWithReason btn btn-success">
                        <i class="far fa-thumbs-up"></i>
                        تفعيل</a>
                  
                @endif

{{--                @if(auth()->user()->id != $charge->supervisor_id)--}}
{{--                @if(auth()->user()->hasPermissionTo('edit_charges'))--}}

{{--                        @if($charge->destroyed_at == null)--}}

{{--                @endif--}}
{{--                @endif--}}

{{--                    @if($charge->destroyed_at == null)--}}

{{--                    @if(auth()->user()->hasPermissionTo('delete_charges'))--}}


{{--                @endif--}}
{{--                @endif--}}
{{--                @if(auth()->user()->hasPermissionTo('destroy_charges'))--}}

{{--                @endif--}}

{{--            @endif--}}
            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>إسم العهدة</th>
        <th>الموظف المسند اليه العهدة</th>
        <th>الموظف</th>
        <th>تاريخ الإسناد</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>

<!-- activation  Modal -->
<div class="modal fade" id="myModal_active" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_header" class="modal-title">تفعيل المستخدم</h4>
            </div>
            <div class="modal-body">
                <label for="reason">كود التأكيد</label>
                <input type="number" id="confirm_code" name="code" placeholder="أدخل كود التأكيد"  class="form-control" >
            </div>
            <div class="modal-footer">
                    <button id="activeButton" type="button" class="btn btn-success">تأكيد</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
            </div>
        </div>

    </div>
</div>
