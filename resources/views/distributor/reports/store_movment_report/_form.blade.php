{!! Form::open(['method'=>'get','route'=>'distributor.reports.store_movement_report.report','class'=>'clearfix
m-form m-form--fit m-form--label-align-right'])!!}
<div class="m-portlet__foot m-portlet__foot--fit full--width">
    <div class="m-form__actions">
        <div class="form-group m-form__group">
            <label>من تاريخ</label>
            {!! Form::date('to_date',null,['class'=>'form-control m-input'])!!}
        </div>

        <div class="form-group m-form__group">
            <label>الى تاريخ</label>
            {!! Form::date('to_date',null,['class'=>'form-control m-input'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>اسم المستودع</label>
            {!! Form::select('store_id',$stores,null,['class'=>'form-control m-input'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>اسم المنتج</label>
            {!! Form::select('product_id',$products,null,['class'=>'form-control m-input'])!!}
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</div>

{!!Form::close()!!}
