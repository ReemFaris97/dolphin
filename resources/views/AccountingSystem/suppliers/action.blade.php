
    <a href="{{route('accounting.suppliers.show',$row->id)}}" data-toggle="tooltip"
       data-original-title="كشف سداد  ">كشف حساب  </a>
    @can('تعديل مورد')
        <a href="{{route('accounting.suppliers.edit',$row->id)}}" data-toggle="tooltip"
           data-original-title="تعديل">تعديل </a>
    @endcan
    @if ($row->is_active==0)
        <a href="{{route('accounting.suppliers.is_active',$row->id)}}"
           data-toggle="tooltip" data-original-title=" تفعيل "> تفعيل</a>
    @else
        <a href="{{route('accounting.suppliers.dis_active',$row->id)}}"
           data-toggle="tooltip" data-original-title=" الغاء التفيل">الغاء التفعيل </a>
    @endif
    @can('حذف المورد')
        <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف">
            حذف</a>

        {!!Form::open( ['route' => ['accounting.suppliers.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
        {!!Form::close() !!}
    @endcan


