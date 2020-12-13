{!! Form::open(['method'=>'get','route'=>'distributor.reports.store_movement.report','class'=>'clearfix
m-form m-form--fit m-form--label-align-right'])!!}
        <div class="m-form__actions">

<div class="m-portlet__foot m-portlet__foot--fit full--width">
    <div class="row">
        <div class="form-group m-form__group col-md-6 pt-3">
            <label>من تاريخ</label>
            {!! Form::text('from_date',request()->from_date,['class'=>'form-control m-input datepicker'])!!}
        </div>

        <div class="form-group m-form__group  col-md-6">
            <label>الى تاريخ</label>
            {!! Form::text('to_date',request()->to_date,['class'=>'form-control m-input datepicker'])!!}
        </div>
        <div class="form-group m-form__group  col-md-6">
            <label>اسم المستودع</label>
            {!! Form::select('store_id',$stores,request()->store_id,['class'=>'form-control m-input select2','placeholder'=>"الكل"])!!}
        </div>
        <div class="form-group m-form__group  col-md-6">
            <label>اسم المنتج</label>
            {!! Form::select('product_id',$products,request()->product_id,['class'=>'form-control m-input select2','placeholder'=>"الكل"])!!}
        </div>
    </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</div>

{!!Form::close()!!}
