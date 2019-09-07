// $('.file-upload').fileinput({
//     showUpload: false,
//     rtl: true,
//     showRemove: true,
//     showClose: true,
//     language: 'ar',
//
// });
//
// function deleteImage(btn, url) {
//
//     $.ajax({
//         url: url,
//         method: 'post',
//         success: function (data) {
//             if (data.status == 1) {
//                 alert(data.msg);
//                 $(btn).closest('.col-sm-3').remove();
//             }
//         }
//     })
// }
//
// $('.icon-picker').iconpicker({
//
//     arrowPrevIconClass: 'fas fa-angle-right',
//     arrowNextIconClass: 'fas fa-angle-left',
//     cols: 10,
// });

$('.summernote').summernote({
    height: 300,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true                  // set focus to editable area after initializing summernote
});



$('.datepicker').datepicker({


    format: "dd-mm-yyyy",
    rtl: true,
    language: 'ar',
    templates: {
        rightArrow: '<i class="la la-angle-left"></i>',
        leftArrow: '<i class="la la-angle-right"></i>'
    }
});


$('.timepicker').timepicker({

    rtl: true
});
$('.select2').select2();

///////////////////////////////////////////////////////////////////////////////

function get_options_string(arr, text = 'name', value = "id", placeholder = "اختر") {

    var options = '<option value="" selected disabled>' + placeholder + '</option>';
    arr.forEach(function (item) {

        options += '<option value="' + item[value] + '">' + item[text] + '</option>';
    })

    return options;
}

function change_select_options(select_name, options) {
    $('select[name="' + select_name + '"]').html(options);
}


function item_selected(selected, meta_name, wanted, changeable_select_name) {

    var string_data = document.querySelector("meta[name=" + meta_name + "]").content,
        all_data = JSON.parse(string_data),
        select_input_data = all_data[selected],
        wanted_array = select_input_data[wanted],
        options = get_options_string(wanted_array);
    change_select_options(changeable_select_name, options)
}


function change_inputs(value) {

    if (value == 'period') {

        $('.after_task-task,.depends-task,.date-task').addClass('d-none').removeClass('d-block');
        $('.period-task').addClass('d-block').removeClass('d-none')
    } else if (value == 'date') {

        $('.after_task-task,.period-task,.depends-task').addClass('d-none').removeClass('d-block');
        $('.date-task').addClass('d-block').removeClass('d-none');

    } else if (value == 'after_task') {

        $('.date-task,.depends-task,.period-task').addClass('d-none').removeClass('d-block');
        $('.after_task-task').addClass('d-block').removeClass('d-none');
    } else if (value == 'depends') {
        $('.date-task,.after_task-task,.period-task').addClass('d-none').removeClass('d-block');
        $('.depends-task').addClass('d-block').removeClass('d-none');
    }
}


function read_notification(url){

    $.ajax({
        url:url,
        method:'post',
        success:function (data) {
            console.log('done')
        }
    })
}

$('[data-countdown]').each(function() {
    var $this = $(this),
        finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('%D يوم %H  ساعة %M دقيقة %S ثانية'));
    });
});
