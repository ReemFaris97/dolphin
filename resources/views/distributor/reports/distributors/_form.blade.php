{!! Form::open(['method'=>'get','route'=>'distributor.reports.distributor.report','class'=>'clearfix
m-form m-form--fit m-form--label-align-right'])!!}
        <div class="m-form__actions">

<div class="m-portlet__foot m-portlet__foot--fit full--width">
    <div class="row">
        <div class="form-group m-form__group  col-md-4 pt-3">
            <label>المندوب</label>
            {!! Form::select('distributor_id',$distributors,request()->distributor_id,['class'=>'form-control m-input select2','placeholder'=>"الكل"])!!}
        </div>


        <div class="form-group m-form__group  col-md-4">
            <label>العام</label>
            {!! Form::text('year',request()->from_date??date('Y'),['class'=>'form-control  m-input','id'=>'yearpicker'])!!}
        </div>
        <div class="form-group m-form__group  col-md-4">
            <label>الشهر</label>

            {!! Form::select('month',
            Illuminate\Support\Collection::times(12)->mapWithKeys(function($val)
            {
                return[$val=>$val];
            })
            ,request()->month,['class'=>'form-control m-input select2','placeholder'=>' الكل '])!!}
        </div>



    </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</div>

{!!Form::close()!!}
@push('scripts')
<script>

$("#yearpicker").datepicker( {
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years",
    rtl: true,
    language: 'ar',
    templates: {
        rightArrow: '<i class="la la-angle-left"></i>',
        leftArrow: '<i class="la la-angle-right"></i>'
    }
});

</script>
@endpush
