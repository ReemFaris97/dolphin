$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  faces;

    $("#branch_id").on('change', function() {
        var idddd = $(this).val();

   

        $.ajax({
            url: "/accounting/faces_branch/" + idddd,
            type: "GET",

        }).done(function (data) {

            faces=[];
            if(data.length ==0)
                data.push('لا توجد  اوجه لفرع');
            var val;
            faces.push('<option selected> اختر الوجه</option>');
            $.each(data, function(i,n){
                val = i;
                faces.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                console.log("asdas");
            else
            $('#face_id').attr('disabled',false);
            $('.face_id').attr('data-live-search',true);
            $('.face_id').attr('placeholder',"اختر الوجه");
            $('#face_id').find('option').remove().end().append(faces);
            $('.face_id option').prop('selected', false);

            $("#face_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });
    });



});
