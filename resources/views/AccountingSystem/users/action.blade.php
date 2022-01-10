<a href="{{route('accounting.user_permissions.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-users" style="margin-left: 10px"></i> </a>

<a href="{{route('accounting.users.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

<a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

{!!Form::open( ['route' => ['accounting.users.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
{!!Form::close() !!}
