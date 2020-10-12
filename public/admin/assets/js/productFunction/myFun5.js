		function myFun5(event) {
			event.preventDefault();
			var service_data = {};
			service_data.service_type = $('#service_type option:selected').text();
			service_data.service_type_type = $('#service_type').val();
			service_data.sevices_price = $('#sevices_price').val();
			service_data.sevices_code = $('#sevices_code').val();
			if (service_data.sevices_price !== '' && service_data.sevices_code !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة  الخدمة بنجاح",
					text: "",
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigDataService.push(service_data);
				$("#serviceTable-wrap").show();
				var appendService = bigDataService.map(function(service) {
					return (`
					<tr class="single-product">
                    	<td class="service-service_type">${service.service_type}</td>
						<td class="service-sevices_price">${service.sevices_price}</td>
						<td class="service-sevices_code">${service.sevices_code}</td>
	                  <td>
						<a href="#" data-toggle="modal" class="edit-this-row-service" data-target="#exampleModal5" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row-service" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
				<input type="hidden" name="service_type[]" value="${service.service_type}" >
				<input type="hidden" name="sevices_price[]" value="${service.sevices_price}" >
				<input type="hidden" name="sevices_code[]" value="${service.sevices_code}" >
					</tr>
					`);
				});
				$('.add-services').empty().append(appendService);
				//////////////////////////////////////////////////////////////////////
				$('.delete-this-row-service').click(function(e) {
					var $this = $(this);
					var row_index_service = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذا  الخدمة؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigDataService.splice(row_index_service, 1);
						} else {
							swal("تم االإلفاء", "حذف  الخدمة تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row-service').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal5 #sevice_type').val($this.parents('tr').find('.sevice_type').html());
					$('#exampleModal5 #sevices_price').val($this.parents('tr').find('.sevices_price').html());
					$('#exampleModal5 #sevices_code').val($this.parents('tr').find('.sevices_code').html());
					var row_index_service = $(this).parents('tr').index();
					bigDataService.splice(row_index_service, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			} ///if_end
		}
