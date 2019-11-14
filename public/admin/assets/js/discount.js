$(function() {
    $("#discount_id").on('change', function () {
        var id = $(this).val();

      if (id =='quantity')
      {

      $("#discounts_button").show();

          $(".percent").hide();

      }


        if (id =='percent')
        {

            $(".percent").show();

            $("#discounts_button").hide();

        }



    });
});