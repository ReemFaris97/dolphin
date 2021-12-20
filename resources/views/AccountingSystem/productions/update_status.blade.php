<form class="form-horizontal  " method="get"
      action="{{route('accounting.productions.updateStatus',$production->id)}}">
    <div class="form-group row ">
        <div class="col-12 ">
            <label class="  control-label"> تعديل الحالة </label>
            {!! Form::select('status',['new'=>'جديد','finished'=>'تم التصنيع'], $production->status,['class' =>'form-control select2','placeholder'=>'اختر الحالة '  ]) !!}

        </div>
    </div>
    <div class="form-group row text-center">
        <button type="submit"
                class="btn btn-primary   col-12 waves-effect waves-light">
            حفظ
        </button>
    </div>
</form>

