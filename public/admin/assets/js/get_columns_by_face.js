$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  columns;

    $("#face_id").on('change', function() {
        var idddd = $(this).val();

        console.log(idddd);


        $.ajax({
            url: "/accounting/columns_face/" + idddd,
            type: "GET",

        }).done(function (data) {

            columns=[];
            if(data.length ==0)
                data.push('لا توجد  اوجه لفرع');
            var val;
            columns.push('<option disabled selected> اختر العمود</option>');
            $.each(data, function(i,n){
                val = i;

                columns.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                console.log("dsaasd");
            else

                $('#face_id').attr('disabled',false);
            $('.column_id').attr('data-live-search',true);
            $('.column_id').attr('placeholder',"اختر العمود");
            $('#column_id').find('option').remove().end().append(columns);
            $("#column_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });
    });


    
});
