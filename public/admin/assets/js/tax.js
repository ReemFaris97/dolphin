$(function() {
    $("#tax").on('change', function () {
        var id = $(this).val();


      if (id =='1')
      {

      $("#tax").show();



      }


        if (id =='0')
        {



            $("#tax2").hide();

        }



    });
});