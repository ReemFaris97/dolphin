$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  products;

    $(".form_store_id").on('change', function() {
        var idddd = $(this).val();

        console.log(idddd);



        $.ajax({
            url: "/accounting/products_store/" + idddd,
            type: "GET",

        }).done(function (data) {

            products =[];
            if(data.length ==0)
                data.push('لا توجد  اصناف بهذا المخزن');
            var val;
            products.push('<option disabled selected> اختر الصنف</option>');
            $.each(data, function(i,n){
                val = i;

                products.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                console.log("dsaasd");
            else

                $('.form_store_id').attr('disabled',false);
            $('.product_id').attr('data-live-search',true);
            $('.product_id').attr('placeholder',"اختر الصنف");
            $('#product_id').find('option').remove().end().append(products);
            $("#product_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });
    });



});
