@extends('AccountingSystem.layouts.master')
@section('title','    دفع اجور الموظفين ')
@section('parent_title','  إدارةالموظفين ')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  دفع  الرواتب</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.users.pay' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            <div class="form-group col-sm-6 col-xs-12 pull-left">
                <label> دفع رواتب  </label>
                {!! Form::select("type",['one_employee'=>'موظف واحد','job_title'=>'مسمى وظيفى كامل','all'=>'كل الموظفين'],Null,['class'=>'form-control','id'=>'type'])!!}
            </div>

            <div class="form-group col-xs-6 pull-left one_employee">
                <label>  اختر اسم الموظف </label>
                {!! Form::select("user_id",$users,null,['class'=>'form-control js-example-basic-single','id'=>'user_id','placeholder'=>' اختر  اسم الموظف  '])!!}
                </div>

                <div class="form-group col-xs-6 pull-left one_employee">
                    <label> مكافئة </label>
                    {!! Form::text("bouns",null,['class'=>'form-control','placeholder'=>'  مكافئة '])!!}
                </div>


                <div class="form-group col-xs-6 pull-left job_title ">
                    <label>  اختر المسمى الوظيفى </label>
                    {!! Form::select("title_id",$titles,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر المسمى الوظيفى '])!!}
                </div>
                <div class="text-center col-md-12">
                    <div class="text-right">
                        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>

            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection

 @section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

 <script>
     $(document).ready(function () {
         $('.js-example-basic-single').select2();
        //  $('.one_employee').hide();
         $(".job_title").hide();


     });
 </script>
 <script>
 $('#type').change(function() {
    var type = $('#type').val();
    if (type=='one_employee'){
        $('.one_employee').show();
        $('.job_title').hide();
    }else if(type=='job_title') {
        $('.job_title').show();
        $('.one_employee').hide();
    }else if(type=='all') {
        $('.job_title').show();
        $('.one_employee').hide();
    }
});

</script>
@endsection
