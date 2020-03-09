$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var branches;
    $(".company_id").on('change', function() {
        var id = $(this).val();
        console.log(id);

        $.ajax({
            url:"/accounting/companes_store/"+id,
            type:"GET",

        }).done(function (data) {
            // var newOption = new Option(data.text, data.id, false, false);
            // $('#city_id').append(newOption).trigger('change');
            $('.store_id').html(data.data);
        }).fail(function (error) {
            console.log(error);
        });

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $.ajax({
            url:"/accounting/company_branch/"+id,
            type:"GET",
            // error:function (data) {
            //     // console.log();
            //     if (data.status==401){
            //         window.location.href='/sign_in';
            //     }
            // },

        }).done(function (data) {
            // var newOption = new Option(data.text, data.id, false, false);
            // $('#city_id').append(newOption).trigger('change');
            branches=[];
            if(data.length ==0)
                data.push('لا توجد فروع فى هذه الشركة');
            var val;

            $.each(data, function(i,n){
                val = i;

                branches.push('<option value='+i+'>'+n+'</option>');
            });
            if(val==0)
                $('#branch_id').attr('disabled',true);
            else

                $('#branch_id').attr('disabled',false);
            $('.branch_id').attr('data-live-search',true);
            $('#branch_id').find('option').remove().end().append(branches);
			$('.branch_id option').prop('selected', false);

            $("#branch_id").selectpicker('refresh');
            // console.log(data);
        }).fail(function (error) {
            console.log(error);
        });

     });


});
