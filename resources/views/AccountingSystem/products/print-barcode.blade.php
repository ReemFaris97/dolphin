<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <style>
        body {
            margin: 0;
            direction: rtl;
        }

        .barcode-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            -webkit-print-color-adjust: exact;

        }
        @media print {
            .barcode-wrapper {page-break-after: always;}
        }
        p {
            margin: 0;
        }

        .data {
            text-align: center;
            font-size: 13px;
            font-weight: 700;

        }

        img[alt='logo'] {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
@for($i=0;$i< $printCount;$i++)
    <div class="barcode-wrapper" style="width: 80mm; height: 40mm">
        <img src="{{asset('admin/logo-black.png')}}" alt="logo" style="width: 20mm; height: 15mm"/>
        <?php echo \DNS1D::getBarcodeHTML($product->bar_code, "C39", 1) ?>
        <div class="data">
            <p> {{$product->bar_code}}</p>
            <p> {{$product->name}}  </p>
            <p>{{$product->selling_price}} ريال</p>
        </div>
    </div>
@endfor


<script type="text/javascript" src="{{ asset('admin/assets/js/core/libraries/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        setTimeout(function (){
            window.print();
        },200);
    });
</script>

</body>
</html>


