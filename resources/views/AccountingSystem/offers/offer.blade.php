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

<form method="post" action="{{route("accounting.offers.notification")}}">
    @csrf
    <input type="hidden" name="package_id" value="{{$package->id}}">

    <input type="hidden" name="client_id" value="{{$client->id}}">

    <button type="submit" class="btn btn-success ">قبول السعر</button>
</form>

{{--@dd("sdddddd")--}}

    </div>
</div>
</body>
</html>

