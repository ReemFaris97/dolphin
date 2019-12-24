<html lang="ar">
<head>
    <style>
        body{

        }

    </style>
</head>

<body style="padding: 4em !important;
        color: #041735 !important;
        direction:rtl !important;
        background-color: #ccc;
        background-image: url('{{ url('public/images/1538568220.png') }}');
        ">

<div style="margin: auto;
    width: 80%;
    border: 3px solid green;
    padding: 10px;
    background:rgba(255,255,255,.8) !important;
    text-align: center;">

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
<form method="post" action="{{route("accounting.offers.notification",$client->id)}}">
    @csrf
    <input type="hidden" name="package" value="{{$package->id}}">

    <button type="submit" class="btn btn-success ">قبول السعر</button>
</form>

{{--@dd("sdddddd")--}}

    </div>
</div>
</body>
</html>

