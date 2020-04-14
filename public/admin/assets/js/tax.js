$(function () {
	$('input[name="price_has_tax"]').click(function () {
		if ($(this).is(':checked')) {
			var id = $(this).val();
			if (id == 1) {

				$(".prices_taxs").show();
			} else if (id == 0) {
				$(".prices_taxs").hide();
			}
		}
	});

});