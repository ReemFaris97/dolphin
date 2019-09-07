<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>الصورة</th>
        <th>الإسم</th>
        <th>المخزن</th>
{{--        <th>الكمية بالوحدة</th>--}}
        <th>الحد الأدنى</th>
        <th>الحد الأقصى</th>
        <th>السعر</th>
        <th>الباركود</th>
{{--        <th>تاريخ الصلاحية</th>--}}
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td><img src="{!!asset($row->image)!!}" height="100" width="100"/></td>
            <td>{!! $row->name !!}</td>
            <td>{!! $row->store->name !!}</td>
{{--            <td>{!! $row->quantity_per_unit !!}</td>--}}
            <td>{!! $row->min_quantity !!}</td>
            <td>{!! $row->max_quantity !!}</td>
            <td>{!! $row->price !!}</td>
            <td>
{{--                {{ \Milon\Barcode\DNS1D::getBarcodeHTML($row->bar_code, "PHARMA2T",3,33)}}--}}
                <?php echo \Milon\Barcode\DNS1D::getBarcodeHTML($row->bar_code, "C39",1) ?>
            </td>
{{--            <td>{!! $row->expired_at !!}</td>--}}
            <td>
                <a href="{!!route('distributor.products.show',$row->id)!!}" class="btn btn-warning"> <i class="fas fa-book"></i> تفاصيل</a>
                <a href="{!!route('distributor.products.edit',$row->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('distributor.products.destroy',$row->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>
                <a href="{!! route('distributor.products.quantity.form',$row->id) !!}" class="btn btn-primary"> <i class="fas fa-pen"></i>إضافة كمية</a>
            </td>
        </tr>
    @endforeach
    </tbody>
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>الاسم</th>--}}
{{--        <th>الاعدادت</th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
</table>
