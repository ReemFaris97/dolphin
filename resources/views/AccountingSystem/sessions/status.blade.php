@if($row->status=='open')
    <a href="{{route('accounting.sessions.close',$row->id)}}" data-toggle="tooltip"  class="btn btn-danger" > اغلاق  الجلسه</a>
@elseif($row->status=='closed')
    <label class="lable lable-warning">مغلقة </label>
@else
    <label class="lable lable-warning">تم  تاكيد الاغلاق  </label>

@endif
