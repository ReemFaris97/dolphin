


<a href="{!!route('distributor.clients.show',$row->id)!!}" class="btn btn-warning">
    <i  class="fas fa-book"></i> تفاصيل</a>
<a href="{!!route('distributor.clients.edit',$row->id)!!}" class="btn btn-primary">
    <i class="fas fa-pen"></i> تعديل</a>
<a href="#" onclick="Delete({{$row->id}})" data-original-title="حذف"
   class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> حذف</a>
{!!Form::open( ['route' => ['distributor.clients.destroy',$row->id] ,'id'=>'delete-form'.$row->id,
'method' => 'Delete']) !!}
{!!Form::close() !!}

