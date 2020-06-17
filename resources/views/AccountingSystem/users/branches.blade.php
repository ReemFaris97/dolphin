@foreach($branches as $value)
<div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
<input type="checkbox" name="branches[]" value="{{$value->id}}" class="switchery branch" id="branch-{{$value->id}}" >
<label style="margin-left: 20px;"  for=branch-{{$value->id}}>
{{ $value->name }}
</label>
</div>
@endforeach


    <script>

        $('.branch').change(function () {
            if ($(this).is(":checked")) {
                var branch_id = $(this).val();
                $.ajax({
                    url: "/accounting/getStoresPermission/" + branch_id,
                    type: "GET",
                }).done(function (data) {

                    $('.stores').append(data.store);
                }).fail(function (error) {
                    console.log(error);
                });


            }

        });
    </script>
