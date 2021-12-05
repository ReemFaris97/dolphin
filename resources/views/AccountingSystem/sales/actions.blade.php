<a href="{{route('accounting.sales.show',$id)}}" data-toggle="tooltip"  target="_blank" data-original-title="عرض الفاتورة"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
<a href="{{route('accounting.sales.show',['sale'=>$id,'print'=>'a4'])}}"  target="_blank" data-toggle="tooltip" data-original-title="عرض الفاتورة"> <i class="icon-printer text-inverse" style="margin-left: 10px"></i> </a>
<a href="{{route('accounting.sales.edit',$id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

<a href="#" onclick="Delete({{$id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

{!!Form::open( ['route' => ['accounting.sales.destroy',$id] ,'id'=>'delete-form'.$id, 'method' => 'Delete']) !!}
{!!Form::close() !!}
