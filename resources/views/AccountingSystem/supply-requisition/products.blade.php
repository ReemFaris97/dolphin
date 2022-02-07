<tr>
    <td>{{$product->name}}
        {!! Form::hidden("products[{$index}][accounting_product_id]",$product->id) !!}
    </td>
    <td>{{Arr::first($product->bar_code)}}</td>
    <td>{!! Form::select("products[{$index}][unit]",[$product->main_unit=>$product->main_unit]+$product->sub_units()->pluck('name','name')->toArray(),null,
    ['class'=>'form-control'])
    !!}</td>
    <td>{!! Form::number("products[{$index}][quantity]",1,['class'=>'form-control','step'=>1]) !!}</td>
    <td><a class="btn btn-danger" id="delete-{{$index}}"><i class="fa fa-trash"></i></a></td>
</tr>
