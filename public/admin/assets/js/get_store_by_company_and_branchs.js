$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#branch_id").on('change', function () {
        var e1 = document.getElementById("branch_id");
        var arr = Array.from(e1.selectedOptions);//get array from selectedOptions property
        var list = [];
        arr.forEach(item => list.push(item.value)); //push each item to empty array
        console.log(list);
    });

    // $("#company_id").on('change', function() {
    //     var company_id = $(this).val();
    //     console.log(company_id);



    var stores;
    $("#branch_id").on('change', function() {
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url:"/accounting/branches_store/"+id,
            type:"GET",

        }).done(function (data) {
            // var newOption = new Option(data.text, data.id, false, false);
            // $('#city_id').append(newOption).trigger('change');
            $('#store_id').html(data.data);
        }).fail(function (error) {
            console.log(error);
        });
    });

    });

    // $("#company_id").on('change', function() {
    //     var company_id = $(this).val();
    //     console.log(company_id);
    //
    //
    //         var id = $(this).val();
    //         console.log(id);
    //         $.ajax({
    //             url:"/accounting/companes_store/"+id,
    //             type:"GET",
    //
    //         }).done(function (data) {
    //             // var newOption = new Option(data.text, data.id, false, false);
    //             // $('#city_id').append(newOption).trigger('change');
    //             $('#store_id').html(data.data);
    //         }).fail(function (error) {
    //             console.log(error);
    //         });
    //     });






// });


