@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="form-group col-sm-6 col-xs-12 pull-left">
	<label>تاريخ العملية </label>
	{!! Form::date("date",null,['class'=>'form-control'])!!}
</div>
{{-- <div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>مصدر  العمليه  </label>
    {!! Form::text("source",'قيد يدوى',['class'=>'form-control','readonly'])!!}
</div> --}}
{{--<div class="form-group col-sm-6 col-xs-12 pull-left">--}}
{{--<label>الكود </label>--}}
{{--{!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  الكود   '])!!}--}}
{{--</div>--}}
{{-- <div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  العمليه  </label>
    {!! Form::text("type",'يدوى',['class'=>'form-control','placeholder'=>'  يدوى   ','readonly'])!!}
</div> --}}

{{-- <div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>   المبلغ  </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ  ',])!!}
</div> --}}
<input type="hidden" name="type" value="يدوى">
<input type="hidden" name="source" value=" قيديدوى">
<div class="form-group col-sm-6 col-xs-12 pull-left">
	<label> نوع العملة </label>
	{!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>'اختر العملة',])!!}
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left">
	<label> البيان العام </label>
	{!! Form::text("details",null,['class'=>'form-control','placeholder'=>' التفاصيل '])!!}
</div>

<table id="qyoud-table">
	<thead>
		<tr>
			<th> رقم الحركة</th>
			<th>الحساب </th>
			<th> الوصف</th>
			<th> مدين </th>
			<th> دائن </th>
			<th> حذف </th>
		</tr>
	</thead>
	<tbody id="qyoud-table-tbody">
		<tr class="single-row">
			<td>1</td>
			<td>
				<select name="account_id[]" class="form-control">
					@foreach ($accounts as $account)
					<option value={{$account->id}}>{{$account->ar_name}} -{{$account->code}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<input type="text" name="details[{{$account->id}}]" class="form-control">
			</td>
			<td>
				<input type="number" min="0" name="debtor[{{$account->id}}]" class="form-control debtor" value="0">
			</td>
			<td>
				<input type="number" min="0" name="creditor[{{$account->id}}]" class="form-control creditor" value="0">
			</td>
			<td></td>
		</tr>
	</tbody>
	<tfoot>
		<td>
			<button type="button" class="btn btn-success" id="add-new">إضافة حساب اخر <i class="icon-arrow-left13 position-right"></i></button>
		</td>
		<td>1</td>
			<td>

			</td>

			<td>
				<input type="number" min="0" name="debtor_total" class="form-control" id="debtor" readonly>
			</td>
			<td>
				<input type="number" min="0" name="creditor_total"  class="form-control" id="creditor" readonly>
			</td>
			<td>

			</td>

	</tfoot>
</table>

<div class="text-center col-md-12">
	<div class="text-right">
		<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>

	</div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();

	});

	$("#from_account_id").on('change', function() {
		var id = $(this).val();
		console.log(id);
		$('.toAccounts').empty();
		$.ajax({
			url: "/accounting/entries/toAccounts/" + id,
			type: "get",
			data: {
				'ids': id,
			}

		}).done(function(data) {
			$('.perent_account_form').html(data.perent);
			$('.toAccounts').html(data.data);
		}).fail(function(error) {
			console.log(error);
		});
	})
</script>
<script>
	$(document).ready(function(){
		$("#add-new").on('click' , function(){
			var num = $("#qyoud-table-tbody tr").length + 1;
			$("#qyoud-table-tbody").append(`<tr class="single-row">
			<td>${num}</td>
			<td>
				<select name="account_id[]" class="form-control">
					@foreach ($accounts as $account)
					<option value={{$account->id}}>{{$account->ar_name}} -{{$account->code}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<input type="text" name="details" class="form-control">
			</td>
			<td>
				<input type="number" min="0" name="debtor[]" class="form-control debtor" value="0">
			</td>
			<td>
				<input type="number" min="0" name="creditor[]" class="form-control creditor" value="0">
			</td>
			<td>
				<a href="#" class="delete-it">X</a>
			</td>
		</tr>`);
			calc();
			$('.creditor').change(function(){
				$(this).parents('tr').find('.debtor').val('0');
				calc()
			});
			$('.debtor').change(function(){
				$(this).parents('tr').find('.creditor').val('0');
				calc()
			});
			$(".delete-it").on('click' , function(){
				$(this).parents('tr').remove();
				calc()
			})
			function calc(){
				var allCredits = 0;
				var allDebts = 0;
				$('.creditor').each(function(){
					allCredits = allCredits + Number($(this).val());
					$("#creditor").val(allCredits);
				});
				$('.debtor').each(function(){
					allDebts = allDebts + Number($(this).val());
					$("#debtor").val(allDebts);
				})
			}
		})
	})
</script>
@endsection
