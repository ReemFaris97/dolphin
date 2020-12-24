<table class="table table-striped- table-bordered table-hover table-checkable">
    <thead>
        <tr>
            <th> اسم العميل </th>
            <th>كود الفاتورة
            </th>
            <th> الحالة</th>
            <th>تاريخ الزيارة
            </th>
            <th class="noExport">الاعدادات
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($trips as $trip)
        <tr>
            <td>
                <a href="{{route('distributor.clients.show',$trip->trip->client->id)}}" class="btn btn-info">
                    {{$trip->trip->client->name}}</a>
            </td>
            <td>
                @if($trip->trip_report)
                <a href="{!!route('distributor.bills.show',$trip->trip_report->id)!!}" class="btn btn-warning"> <i
                        class="fas fa-book"></i> {{$trip->trip_report->invoice_number}}</a>
                @else
                لاتوجد فاتوره
                @endif
            </td>
            <td>
                @if($trip->type=='accept')
                <span style="color: green"> مقبول</span>
                @elseif($trip->type=='refuse')
                <span style="color: red"> مرفوض</span>
                @endif
            </td>
            <td>{{$trip->created_at->toDateString()}}
            </td>
            <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    المزيد </button>
            </td>

        </tr>
        @endforeach
    </tbody>

</table>

<hr>
<h3> قائمه الاصناف</h3>
<table class="table table-striped- table-bordered table-hover table-checkable">
    <thead>
        <tr>
            <th> اسم الصنف</th>
            <th>الموجود</th>
            <th> المباع</th>
            <th>التصريف</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <th>{{$product['product_name']}} </th>
            <th>{{$product['exists']}} </th>
            <th>
                {{$product['sells']}}
            </th>
            <th>{{$product['selling']}}
            </th>

        </tr>
        @endforeach
    </tbody>

</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">التفاصيل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                        <tr>
                            <th> اسم العميل </th>
                            <th> جوال العميل</th>
                            <th> اسم المسار</th>
                            <th> اسم المندوب
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trips as $trip)

                        <tr>
                            <td>{{$trip->trip->client->name}}

                            </td>
                            <td>{{$trip->trip->client->phone}}</td>
                            <td>{{$trip->trip->route->name}}</td>
                            <td>{{$trip->trip->route->user->name}}</td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
