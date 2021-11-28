<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
        <tr>
            <th>#</th>
            <th>كود الصنف</th>
            <th>اسم الصنف</th>
            <th>المستودع</th>
            <th>نوع الحركه</th>
            <th>طلب النقل</th>
            <th>رقم فاتورة البيع</th>
            <th>الرصيد</th>
        </tr>
    </thead>
    <tbody>
        @foreach($store_products as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{{$row->product->bar_code}}</td>
            <td>{!! $row->product->name !!}</td>
            <td>{!!optional($row->store)->name !!}</td>
            <td>{{$row->movement_type}}</td>
            <td>
                @if($row->store_transfer_request_id!=null)
                <a href="{{route('distributor.storeTransfer.show',$row->store_transfer_request_id)}}"
                    class="btn btn-info"> <i class="fas fa-eye"></i> </a>
                @else
                لا يوجد طلب لحركه النقل
                @endif

            </td>
            <td>
                @if( optional($row->trip_report)->invoice_number!=null)
            <td>
                <a href="{{route('distributor.bills.show', optional($row->trip_report)->invoice_number ) }}">
                    {!! optional($row->trip_report)->invoice_number !!}
                </a>
            </td>
            @else
            لا يوجد فاتوره لهذه الحركه
            @endif
            </td>
            <td>{!! $row->quantity!!}</td>


        </tr>
        @endforeach
    </tbody>
</table>
