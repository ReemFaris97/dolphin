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
    <label>نوع البند </label>
    {!! Form::select("type",['revenue'=>'ايراد','expenses'=>'مصروف'],null,['class'=>'form-control type','placeholder'=>' نوع البند  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <l abel>التاريخ</label>
    {!! Form::date("date",null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-md-6 pull-left ">
    <label>اسم البند  </label>


        <div class="clauses">
            @if (!isset($benod))

                {!! Form::select("clause_id",[],null,['class'=>'form-control js-example-basic-single','placeholder'=>'اختر اسم البند   ','id'=>'clause_id'])!!}
            @else

                {{--{!! Form::select("clause_id",$clauses,null,['class'=>'form-control js-example-basic-single','placeholder'=>'اختر اسم البند   ','id'=>'clause_id'])!!}--}}

                <select class="form-control js-example-basic-single pull-right" name="clause_id">
                    <option disabled selected> إختار اسم البند</option>
                    @forelse($clauses as $clause)
                        @if ($benod->clause_id==$clause->id)
                            <option value="{{$clause->id}}"  selected>{{$clause->ar_name}}</option>
                            @else
                            <option value="{{$clause->id}}" >{{$clause->ar_name}}</option>
                        @endif

                    @empty

                    @endforelse
                </select>

            @endif
        </div>

</div>

@if( isset($benod))

    <div class="form-group col-md-6 pull-left">
        <label>رقم السند </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
        {!! Form::text("sanad_num",$benod->sanad_num,['class'=>'form-control','placeholder'=>' رقم السند  '])!!}

    </div>
@else

    <div class="form-group col-md-6 pull-left">
        <label>رقم السند </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
        {!! Form::text("sanad_num",rand(),['class'=>'form-control','placeholder'=>' رقم السند  '])!!}

    </div>
    @endif
<div class="form-group col-md-6 pull-left">
    <label>البيان  </label>
    {!! Form::textarea("desc",null,['class'=>'form-control','placeholder'=>' وصف البند باللغة الانجليزية    '])!!}
</div>




@if( isset($benod))

    <div class="form-group col-md-6 pull-left">
        <label>صوره المرفقة : </label>
        <img src="{{getimg($benod->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>


@endif


<div class="form-group col-md-6 pull-left ">
    <label>ارفاق صوره </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}
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