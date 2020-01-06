$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var  columns;

    $(".type").on('change', function() {
        var idddd = $(this).val();
     if (idddd==0) {


         //     $.ajax({
         //         url: "/accounting/basic_stores/" + idddd,
         //         type: "GET",
         //
         //     }).done(function (data) {
         //
         //         columns=[];
         //         if(data.length ==0)
         //             data.push('لا توجد  اوجه لفرع');
         //         var val;
         //         columns.push('<option disabled selected> اختر العمود</option>');
         //         $.each(data, function(i,n){
         //             val = i;
         //
         //             columns.push('<option value='+i+'>'+n+'</option>');
         //         });
         //         if(val==0)
         //             console.log("dsaasd");
         //         else
         //
         //             $('#face_id').attr('disabled',false);
         //         $('.column_id').attr('data-live-search',true);
         //         $('.column_id').attr('placeholder',"اختر العمود");
         //         $('#column_id').find('option').remove().end().append(columns);
         //         $("#column_id").selectpicker('refresh');
         //
         //     }).fail(function (error) {
         //         console.log(error);
         //     });
     }
     });


    
});
