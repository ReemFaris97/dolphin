$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  cells;

    $("#cell_id").on('change', function() {
        var idddd = $(this).val();

        console.log(idddd);


        $.ajax({
            url: "/accounting/cells_column/" + idddd,
            type: "GET",

        }).done(function (data) {

            cells=[];
            if(data.length ==0)
                data.push('لا توجد  اوجه لفرع');
            var val;

            $.each(data, function(i,n){
                val = i;

                cells.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                $('#cell_id').attr('disabled',true);
            else

                $('#cell_id').attr('disabled',false);
            $('.cell_id').attr('data-live-search',true);
            $('.cell_id').attr('placeholder',"اختر الوجه");
            $('#cell_id').find('option').remove().end().append(cells);
            $("#cell_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });
    });


    
});
