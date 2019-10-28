.@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if( isset( $transaction))
    @if( $transaction->model_type=='App\Models\AccountingSystem\AccountingBranch')
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
    @elseif( $transaction->model_type=='App\Models\AccountingSystem\AccountingCompany')
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




@if( isset( $transaction))
    @if( $transaction->model_type=='App\Models\AccountingSystem\AccountingBranch')
        <div class="form-group col-md-6 pull-left branches">
            <label> اسم الفرع التابع لها التحويل: </label>
            {!! Form::select("branch_id",$branches, $transaction->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المخزن '])!!}
        </div>
    @elseif( $transaction->model_type=='App\Models\AccountingSystem\AccountingCompany')
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
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>اسم البند </label>
    {!! Form::select("clause_id",$clauses,null,['class'=>'form-control','placeholder'=>' اسم  البند  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>ملاحظات </label>
    {!! Form::textarea("notes",null,['class'=>'form-control','placeholder'=>' ملاحظات    '])!!}
</div>



<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')

    <script>

        $(document).ready(function() {

            $('.companies').show();
            $('.branches').hide();

            $('.js-example-basic-single').select2();
        });

    </script>

    <script>
        function myFunction() {


            $(".companies").show();
            $(".branches").hide();

        }

        function myFunction2() {

            $(".companies").hide();
            $(".branches").show();
        }

    </script>

    @if (isset( $transaction))
        @if( $transaction->model_type=='App\Models\AccountingSystem\AccountingBranch')

            <script>
                $(document).ready(function() {
                    $(".companies").hide();
                    $(".branches").show();
                });


            </script>
        @elseif( $transaction->model_type=='App\Models\AccountingSystem\AccountingCompany')
            <script>
                $(document).ready(function() {
                    $(".companies").show();
                    $(".branches").hide();
                });
            </script>

        @endif
    @endif
@endsection