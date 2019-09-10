<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>
        <th>رقم العرض </th>
        <th>تاريخ العرض</th>
        <th> قيمته</th>


        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <?php
                $total=\App\Models\OfferProduct::where('supplier_offer_id',$offer->id)->sum('price');
        ?>

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$offer-> id!!}</td>
            <td>{!!$offer->created_at!!}</td>
            <td>{!!$total !!}</td>

            <td>
                <a href="{!!route('supplier.offers.edit',$offer->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>
                <form method="POST" action="{!!route('supplier.offers.destroy',$offer->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>



        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>رقم العرض </th>
        <th>تاريخ العرض</th>
        <th> قيمته</th>
        <th>الاعدادت</th>
    </tr>
    </tfoot>
</table>
