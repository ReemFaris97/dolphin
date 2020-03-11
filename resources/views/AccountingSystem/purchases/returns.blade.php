@extends('AccountingSystem.layouts.master')
@section('title','إنشاء  فاتورة مرتجع  جديد')
@section('parent_title','إدارة   المشتريات')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة  فاتورة مرتجع مشترى  جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {{-- <div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" >
                <label> اسم الكاشير </label>
                {{$session->user->name}}
            </div>

            <div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" >
                <label> اسم الوردية </label>
                {{$session->shift->name}}
            </div>

            <div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" >
                <label> تاريخ بدء الجلسة </label>
                {{$session->start_session}}
            </div> --}}

        <form method="post" action="{{route('accounting.purchases.store_returns')}}">
            @csrf

    <div class="form-group col-md-6 pull-left">
        <label>   رقم  فاتورةالبيع   </label>
        {!! Form::select("purchase_id",$purchases,null,['class'=>'form-control js-example-basic-single','id'=>'purchase_id','placeholder'=>'  رقم  فاتورةالمشترى '])!!}
    </div>

<div class="purchases_biles"></div>
<div class="bills_items"></div>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</form>
</div>


</div>

</div>
</div>

@endsection

@section('scripts')
    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();


    });


    // $('body').on('click', '.removeProduct', function () {

    //         var id = $(this).attr('data-id');

    //         // $.ajax({
    //         //     type: "GET",

    //         //     url:'/accounting/returns_Sale/'+id,

    //         //     success: function(data)
    //         //     {


    //         //         $('.sales_biles').html(data.data);

    //         //     },

    //         // });

    //     });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script>


        $("#purchase_id").change(function() {
            var id = $(this).val();


            $.ajax({
                type: "GET",

                url:'/accounting/returns_Purchase/'+id,

                success: function(data)
                {


                    $('.purchases_biles').html(data.data);

                },

            });
        });


        function show(id) {

            $.ajax({
                url: "/accounting/purchase_details/" + id,
                type: "GET",

                success: function(data) {

                    $('.bills_items').empty();
                    $('.bills_items').html(data.items);
                }
            });




}

    </script>


@endsection
