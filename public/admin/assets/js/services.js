$(function() {
    $("#type").on('change', function () {
        var id = $(this).val();
      if (id =='service')
      {
$("#services_button").show();


      }
        if (id !='service')
        {
            $("#services_button").hide();


        }
    });
});