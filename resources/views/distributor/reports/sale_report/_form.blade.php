<form class="Clearfix m-form m-form--fit m-form--label-align-right a-smaller-input-wrapper" enctype="multipart/form-data" method="get" action="">

<div class="m-portlet__foot m-portlet__foot--fit ">
    <div class="m-form__actions">
        <div class="form-group m-form__group">
            <label>   اسم العميل</label>
            {!! Form::select('client_id',$clients,null,['class'=>'form-control m-input select2','placeholder'=>' الكل'])!!}
        </div>

        <div class="form-group m-form__group">
            <label>اسم المندوب</label>
            {!! Form::select('user_id',$distributors,null,['class'=>'form-control m-input   select2 ','placeholder'=>' الكل'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>   اسم المسار</label>
            {!! Form::select('route_id',$routes,null,['class'=>'form-control m-input select2','placeholder'=>' الكل'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>اسم الصنف</label>
            {!! Form::select('product_id',$products,null,['class'=>'form-control m-input select2','placeholder'=>' الكل'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>من تاريخ</label>
            {!! Form::date('from',null,['class'=>'form-control m-input '])!!}
        </div>

        <div class="form-group m-form__group">
            <label>الى تاريخ</label>
            {!! Form::date('to',null,['class'=>'form-control m-input'])!!}
        </div>


        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</div>

</form>
