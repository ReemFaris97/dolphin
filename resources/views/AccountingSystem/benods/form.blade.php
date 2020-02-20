@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="form-group col-md-6 pull-left">
    <label>اسم البند باللغة العربية  </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>' اسم البند باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم البند باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم البند باللغة الانجليزية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>وصف البند باللغة العربية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("ar_description",null,['class'=>'form-control','placeholder'=>' وصف البند باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>وصف البند باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("en_description",null,['class'=>'form-control','placeholder'=>' وصف البند باللغة الانجليزية    '])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')

    <script>

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".type").on('change', function () {

                var type = $(this).val();
                console.log(type);


                $.ajax({
                    url: "/accounting/type_benods/" + type,
                    type: "GET",

                }).done(function (data) {
                    $('.clauses').empty();
                    $('.clauses').append(data.data);

                }).fail(function (error) {
                    console.log(error);
                });
            });
        });




    </script>
@endsection
