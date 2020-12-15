<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الصورة</th>
        <th>الإسم</th>
        {{-- <th>المستودع</th> --}}
       <th>الكمية بالوحدة</th>
        <th>الحد الأدنى</th>
        <th>الحد الأقصى</th>
        <th>السعر</th>
        <th>الباركود</th>
{{--        <th>تاريخ الصلاحية</th>--}}
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td><img src="{!!asset($row->image)!!}" height="100" width="100"/></td>
            <td>{!! $row->name !!}</td>
            {{-- <td>{!!optional($row->store) ->name !!}</td> --}}
           <td>{!! $row->quantity_per_unit !!}</td>
            <td>{!! $row->min_quantity !!}</td>
            <td>{!! $row->max_quantity !!}</td>
            <td>{!! $row->price !!}</td>
            <td>
                <?php
                    try{
                    //حسبى الله ونعم والوكيل

                        echo \Milon\Barcode\DNS1D::getBarcodeHTML($row->bar_code, "C39",1);
                }
                catch(\Exception $e){

                }
                    ?>

                {{ $row->bar_code }}

            </td>
{{--            <td>{!! $row->expired_at !!}</td>--}}
            <td>
                <a href="{!!route('distributor.products.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>
                <a href="{!!route('distributor.products.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>

                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.products.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

                <a href="{!! route('distributor.products.quantity.form',$row->id) !!}" class="btn btn-primary"> <i class="fas fa-pen"></i>إضافة كمية</a>
            </td>
        </tr>
    @endforeach
    </tbody>
   <th>#</th>
    <th>الصورة</th>
    <th class="filter">الإسم</th>
    {{-- <th>المستودع</th> --}}
   <th class="filter">الكمية بالوحدة</th>
    <th class="filter">الحد الأدنى</th>
    <th class="filter">الحد الأقصى</th>
    <th class="filter">السعر</th>
    <th>الباركود</th>
{{--        <th>تاريخ الصلاحية</th>--}}
    <th class="noExport">الاعدادت</th> </tfoot>
</table>
