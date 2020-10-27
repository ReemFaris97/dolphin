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
    <label>مسمى طريقة الدفع  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'مسمى طريقة الدفع '])!!}
</div>

<div class="form-group col-xs-6 pull-left  ">
    <label >‫قناة ‫الدفع‬ الفتراضية‬‫‬ </label>
    <div class="form-line new-radio-big-wrapper">
                <span class="new-radio-wrap">
                    <label for="bank">بنك </label>
{{--                        {!! Form::radio("type",'bank',['class'=>'form-control','id'=>'bank'])!!}--}}
            <input type="radio" name="type" value="bank" class="form-control" id="bank" checked onclick="myfun1()">
                </span>
             <span class="new-radio-wrap">
                    <label for="safe">صندوق </label>
           <input type="radio" name="type" value="safe" class="form-control" id="safe" onclick="myfun2()">
                </span>
    </div>
</div>
<div class="form-group col-xs-6 pull-left banks">
    <label> اسم البنك: </label>
    {!! Form::select("bank_id",$banks,null,['class'=>'form-control js-example-basic-single','id'=>'bank_id','placeholder'=>' اختر اسم  البنك '])!!}
</div>

<div class="form-group col-xs-6 pull-left safes">
    <label> اسم الصندوق: </label>
    {!! Form::select("safe_id",$safes,null,['class'=>'form-control js-example-basic-single','id'=>'safe_id','placeholder'=>' اختر اسم  الصندوق '])!!}
</div>


<div class="form-group col-xs-6 pull-left  ">
    <label > </label>
    <div class="form-line new-radio-big-wrapper">
                <span class="new-radio-wrap">
                    <label for="active">مفعل </label>
                        {!! Form::radio("active",1,['class'=>'form-control','id'=>'active'])!!}
                </span>
        <span class="new-radio-wrap">
                    <label for="dis_active"> غير مفعل </label>
                     {!! Form::radio("active",0,['class'=>'form-control','id'=>'dis_active'])!!}
                </span>
    </div>
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $('.safes').hide();
            $('.banks').show();
        });

        function myfun1() {
            $(".banks").show();
            $(".safes").hide();
        } {


        }
      function myfun2() {

          $(".safes").show();
          $(".banks").hide();
      }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="{{asset('admin/assets/js/get_faces_by_branch.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_cells_by_column.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_columns_by_face.js')}}"></script>

@endsection
