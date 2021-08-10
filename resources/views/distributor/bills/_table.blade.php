<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th> رقم الفاتورة</th>
        <th> اسم العميل </th>
        <th>تاريخ الفاتوره </th>
        <th>إسم المندوب</th>
        <th> قيمة الفاتورة</th>
        <th> حالة  الفاتورة</th>
        <th> نوع الفاتورة</th>
        <th> حاله سداد الفاتورة</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $row)

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!! $row->invoice_number!!}  </td>
            <td>{!!optional(optional($row->route_trip)->client)->name  !!}</td>
           <td>{!! $row->created_at->format('Y-m-d h:m A') !!}</td>
            <td>{!! optional($row->route_trip)->route->user->name !!}</td>
            <td>{!!$row->product_total() !!}</td>
            <td>
                @if(optional($row->inventory)->type=='accept')
              <label class="btn btn-success"> تم القبول</label>
                    @else
                    <label class="btn btn-danger"> تم الرفض</label>
                @endif
            </td>
            <td>
                @if($row->created_at==$row->paid_at)
                    <label class="btn btn-success"> كاش</label>
                @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
                    <label class="btn btn-danger"> أجل مسددة </label>
                @elseif($row->paid_at==null)
                    <label class="btn btn-danger"> أجل</label>
                @endif
            </td>
            <td>
                @if($row->created_at==$row->paid_at)
                    <label class="btn btn-success"> تم السداد</label>
                @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
                    <label class="btn btn-success"> تم السداد </label>
                @elseif($row->paid_at==null)
                    <label class="btn btn-danger">غير مسدده </label>

<button type="button" class="btn btn-outline-danger btn-circle" data-toggle="modal" data-target="#pay-{{$row->id}}">
<i  class="fa fa-coins"></i>
سداد </button>


<div class="modal fade" id="pay-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

   {!!Form::open(
       ['route' => ['distributor.bills.pay',$row->id] ,
       'id'=>'pay-form'.$row->id,
        'method' => 'post']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تسديد فاتوره</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                    <div class="m-portlet__body a-smaller-input-wrapper">
                         <div class="form-group ">
                             <label>الكاش</label>
                                  {!! Form::text('cash',null,['class'=>'form-control m-input','placeholder'=>'الكاش'])!!}
                         </div>

                    </div>

                    <div class="m-portlet__body a-smaller-input-wrapper">
                        <div class="form-group ">
                            <label>شبكة</label>
                         {!! Form::text('visa',null,['class'=>'form-control m-input',   'placeholder'=>'شبكه'])!!}
                        </div>

                    </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
   {{Form::close()}}
    </div>
  </div>
</div>


                @endif
            </td>
            <td>
               <a href="{!!route('distributor.bills.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> الفاتوره</a>
                <a href="{!!route('distributor.bills.images',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i>صور الجرد</a>
                <a href="{!!route('distributor.bills.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.bills.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <th>#</th>
    <th> رقم الفاتورة</th>
    <th> اسم العميل </th>
    <th>تاريخ الفاتوره </th>
    <th>إسم المندوب</th>
    <th> قيمة الفاتورة</th>
    <th> حالة  الفاتورة</th>
    <th> نوع الفاتورة</th>
    <th> حاله سداد الفاتورة</th>
    <th class="noExport">الاعدادت</th>
</table>
