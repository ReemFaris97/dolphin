$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  keepers;

    $(".store_id").on('change', function() {
        var idddd = $(this).val();

        console.log(idddd);
        // alert(idddd);


        $.ajax({
            url: "/accounting/keepers_store/" + idddd,
            type: "GET",

        }).done(function (data) {

            keepers =[];
            if(data.length ==0)
                data.push('لا توجد  امناء بهذا المستودع');
            var val;
            keepers.push('<option disabled selected> اختر الامين </option>');
            $.each(data, function(i,n){
                val = i;

                keepers.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                console.log("dsaasd");
            else

                $('.store_id').attr('disabled',false);
            $('.storekeeper_id').attr('data-live-search',true);
            $('.storekeeper_id').attr('placeholder',"اختر الصنف");
            $('#storekeeper_id').find('option').remove().end().append(keepers);
            $('.storekeeper_id option').prop('selected', false);

            $("#storekeeper_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });
    });



});
