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
            url: "/accounting/store_products/" + idddd,
            type: "GET",

        }).done(function (data) {
          
            $('.store_products').html(data.data);
         
        }).fail(function (error) {
            console.log(error);
        });


        ////////////////////////////////////////////////////////////////////////////////////////////
        var  keepers;
        $.ajax({
            url: "/accounting/keepers_store/" + idddd,
            type: "GET",

        }).done(function (data) {

            keepers = [];
            if (data.length == 0)
                data.push('لا توجد  امناء بهذا المخزن');
            var val;
            keepers.push('<option disabled selected> اختر الامين </option>');
            $.each(data, function (i, n) {
                val = i;

                keepers.push('<option value=' + i + '>' + n + '</option>');
            });
            if (val == 0)
                console.log("dsaasd");
            else

            $('.form_store_id').attr('disabled', false);
            $('.storekeeper_id').attr('data-live-search', true);
            $('.storekeeper_id').attr('placeholder', "اختر الصنف");
            $('#storekeeper_id').find('option').remove().end().append(keepers);
            $('.storekeeper_id option').prop('selected', false);

            $("#storekeeper_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });

    // });

      ////////////////////////////////////////////////////////////////////////////////////////////
      var  stores;

      $.ajax({
          url: "/accounting/stores_to/" + idddd,
          type: "GET",


      }).done(function (data) {

        stores = [];

          if (data.length == 0)
              data.push('لا توجد بهذا المخزن');
          var val_1;
          stores.push('<option disabled selected> اختر المخزن </option>');
          $.each(data, function (i, n) {
              val_1 = i;

              stores.push('<option value=' + i + '>' + n + '</option>');
          });
          if (val_1 == 0)
              console.log("dsaasd");
          else

          $('.form_store_id').attr('disabled', false);
          $('.to_store_id').attr('data-live-search', true);
          $('.to_store_id').attr('placeholder', "اختر المخزن");
          $('#to_store_id').find('option').remove().end().append(stores);
          $("#to_store_id").selectpicker('refresh');

      }).fail(function (error) {
          console.log(error);
      });
    });

});
