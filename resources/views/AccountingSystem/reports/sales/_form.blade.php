<form  method="get" >
    <div class="form-group col-sm-3">
        <label> الشركة </label>
         {!! Form::select("company_id",companies(), request('company_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
</div>
<div class="form-group col-sm-3">
    <label> الفرع </label>
    <select name="branch_id" data-live-search="true"
            class="selectpicker form-control inline-control" id="branch_id">
        <option value="" selected="" disabled="">اختر الفرع</option>
        @foreach(branches() as $index=>$branch)
            <option
                value="{{ $index }}" {{$index == request('branch_id') ? 'selected':''}}>{{ $branch }}</option>
        @endforeach

    </select>
</div>

<div class="form-group col-sm-3">
    <label> المستودع </label>
    <select name="store_id" data-live-search="true" id="store_id"
            class="selectpicker form-control inline-control">
        <option selected disabled>اختر المستودع</option>
        @foreach(allstores() as $store)
            <option
                value="{{$index}}"
                {{$index == request('store_id')?'selected':''}}>{{$store}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-3">
    <label> الكاشير </label>
    <select name="user_id" data-live-search="true"
            class="selectpicker form-control inline-control" id="user_id">
            <option selected disabled value=" ">اختر الموظف</option>
            @foreach(\App\Models\User::where('is_saler',1)->pluck('name','id') as $id=>$name)
            <option value="{{$id}}">{{$name}} </option>
            @endforeach
        </select>
</div>


<div class="form-group col-sm-3">
    <label for="from"> الفترة من </label>
    {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
</div>
<div class="form-group col-sm-3">
    <label for="to"> الفترة إلي </label>
    {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
</div>

<div class="form-group col-sm-12">
    <button type="submit" class="btn btn-success btn-block">بحث</button>
</div>
</form>
