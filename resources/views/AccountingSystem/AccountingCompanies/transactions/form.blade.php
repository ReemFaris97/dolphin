.@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if( isset($store))
    @if($store->model_type=='App\Models\AccountingSystem\AccountingBranch')
        <div class="form-group">
            <label class="display-block text-semibold">التحويل تابع الى</label>
            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" class="styled" id="company"  onclick="myFunction()" disabled>
                شركة
            </label>

            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" checked="checked"disabled >
                فرع
            </label>
        </div>
    @elseif($store->model_type=='App\Models\AccountingSystem\AccountingCompany')
        <div class="form-group">
            <label class="display-block text-semibold">التحويل تابع الى</label>
            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()" disabled>
                {!! auth('accounting_companies')->user()->name !!}

            </label>

            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" disabled>
                فرع
            </label>
        </div>
    @endif
@else
    <div class="form-group">
        <label class="display-block text-semibold">التحويل تابع الى</label>
        <label class="radio-inline">
            <input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()">
            {!! auth('accounting_companies')->user()->name !!}
        </label>

        <label class="radio-inline">
            <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()">
            فرع
        </label>
    </div>
@endif




@if( isset($store))
    @if($store->model_type=='App\Models\AccountingSystem\AccountingBranch')
        <div class="form-group col-md-6 pull-left branches">
            <label> اسم الفرع التابع لها التحويل: </label>
            {!! Form::select("branch_id",$branches,$store->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المخزن '])!!}
        </div>
    @elseif($store->model_type=='App\Models\AccountingSystem\AccountingCompany')
        <div class="form-group col-md-6 pull-left companies">
            <label> التحويل تابع الى الشركة مباشرا</label>
            <input name="company_id" type="hidden" value="{{auth('accounting_companies')->user()->id}}">
        </div>
    @endif

@else
    <div class="form-group col-md-6 pull-left companies">
        <label> التحويل تابع الى الشركة مباشرا </label>
        <input name="company_id" type="hidden" value="{{auth('accounting_companies')->user()->id}}">
    </div>
    <div class="form-group col-md-6 pull-left branches">
        <label> اسم الفرع التابع لها التحويل: </label>
        {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المخزن '])!!}
    </div>
@endif




<div class="form-group col-md-6 pull-left">
    <label>المبلغ </label>
    {!! Form::text("default",null,['class'=>'form-control','placeholder'=>' المبلغ    '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>نوع البند </label>
    {!! Form::select("type",['revenue'=>'ايراد','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع البند  '])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
