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
        <h2>  عرض اسعار للمنتجات</h2>
    </div>
    <div style=" float: right;
        width: 30%;
        margin: 0;
        padding: 0 5px;
        font-weight: bold;
        align-content: center;">
{{--@dd($client->id)--}}

<a href="{{route("accounting.offers.notification",['package_id'=>$package->id,'client_id'=>$client->id])}}">
    قبول السعر

</a>

{{--@dd("sdddddd")--}}

    </div>
</div>
</body>
</html>

