<a href="{{route('accounting.sessions.show',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
<a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

{!!Form::open( ['route' => ['accounting.sessions.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
{!!Form::close() !!}
