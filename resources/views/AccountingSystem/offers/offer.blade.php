<html lang="ar">
<head>
    <style>
        body{

        }

    </style>
</head>

<body>

<div>

    <div style=" float: right;
        width: 65%;
        margin: 0;
        padding: 0 5px;
        align-content: center;">
        <h2>  عرض اسعار للاصناف</h2>
        <h3>  الاجمالى:{{$package->total}}</h3>
    </div>
    <div style=" float: right;
        width: 30%;
        margin: 0;
        padding: 0 5px;
        font-weight: bold;
        align-content: center;">


        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>  المنتج   </th>
                    <th>  الكميه   </th>
                    <th>  السعر </th>


                </tr>
                </thead>
                <tbody>

                @foreach($package->offers as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->price!!}</td>


                    </tr>

                @endforeach



                </tbody>
            </table>
        </div>
<a href="{{route("accounting.offers.notification",['package_id'=>$package->id,'client_id'=>$client->id,'status'=>'accept'])}}">
    قبول السعر

</a>

        <a href="{{route("accounting.offers.notification",['package_id'=>$package->id,'client_id'=>$client->id,'status'=>'refused'])}}">
            رفض السعر

        </a>

{{--@dd("sdddddd")--}}

    </div>
</div>
</body>
</html>

