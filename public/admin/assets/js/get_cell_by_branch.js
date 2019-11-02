$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#branch_id").on('change', function() {
        var idddd = $(this).val();

        console.log(idddd+"ffffffffffffff");


        $.ajax({
            url: "/accounting/cells_branch/" + idddd,
            type: "GET",

        }).done(function (data) {
            // var newOption = new Option(data.text, data.id, false, false);
            // $('#city_id').append(newOption).trigger('change');
            $('.cell_id').html(data.data);
        }).fail(function (error) {
            console.log(error);
        });
    });


    
});
