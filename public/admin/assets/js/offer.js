$(function() {
    $("#type").on('change', function () {
        var id = $(this).val();
      if (id =='offer')
      {
$("#offers_button").show();


      }
        if (id !='offer')
        {
            $("#offers_button").hide();


        }
    });
});