$(function() {
    $("#discount_id").on('change', function () {
        var id = $(this).val();


      if (id =='quantity')
      {

      $("#discounts_button").show();

          $("#nesba-wrp").hide();

      }


        if (id =='percent')
        {

            $("#nesba-wrp").show();

            $("#discounts_button").hide();

        }



    });
});