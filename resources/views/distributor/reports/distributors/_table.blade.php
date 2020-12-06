<table class="table table-striped- table-bordered table-hover">
    <tbody>
        <tr>
            <td>
                عدد المسارات

            </td>
            <td>
                {{$total_routes_during_to_rounds_count}}
            </td>
            <td>
                إجمالي عدد عملاء المسارات
            </td>
            <td>
                {{$trips_counts_during_to_rounds}}
            </td>
        </tr>
        <tr>
            <td>
                عدد العملاء التى تمت زيارتهم
            </td>
            <td>
                {{$total_trips_count}}
            </td>
            <td>
                عدد العملاء المقبوله
            </td>
            <td>
                {{$accepted_trips_count}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                عدد العملاء المرفوضه

            </td>
            <td colspan="2">
                {{$refused_trips_count}}
            </td>

        </tr>
        <tr>
            <td>
                نسبة الإنجاز
            </td>
            <td>
                {{$finishing_percentage}}
            </td>
            <td>
                إجمالي قيمة المبيعات
            </td>
            <td>
                {{$cash}}
            </td>
        </tr>
        <tr>
            <td>
                إجمالي عمولة البيع للمندوب
            </td>
            <td>
                {{$affiliate}}
            </td>
            <td>
                عدد الاصناف
            </td>
            <td>
                {{$products_count}}
            </td>
        </tr>

    </tbody>

</table>

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
        <tr>
            <th>#</th>
            <th>كود الصنف</th>
            <th>اسم الصنف</th>
            <th>الكمية</th>

        </tr>
    </thead>
    <tbody>
        @foreach($products as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{{$row['bar_code']}}</td>
            <td>{!! $row['name'] !!}</td>
            <td>{!!$row['quantity'] !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
