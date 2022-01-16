<a href="{{route('accounting.purchases.show',$row->id)}}" data-toggle="tooltip" data-original-title="مشاهدة"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
<a href="{{route('accounting.purchases.print',$row->id)}}" data-toggle="tooltip" data-original-title="طباعة"> <i class="fas fa-print" style="margin-left: 10px"></i> </a>
<a href="{{route('accounting.purchases.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

<a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

{!!Form::open( ['route' => ['accounting.purchases.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
{!!Form::close() !!}
