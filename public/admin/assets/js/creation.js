$(function() {
    $("#type").on('change', function () {
        var id = $(this).val();
      if (id =='creation')
      {
$("#components_button").show();


      }
        if (id !='creation')
        {
            $("#components_button").hide();


        }
    });
});