{!! Form::open(['method'=>'get','route'=>'distributor.reports.selling_movement.show','class'=>'clearfix
m-form m-form--fit m-form--label-align-right'])!!}
<div class="m-portlet__foot m-portlet__foot--fit ">
    <div class="m-form__actions">

<div class="row">
        <div class="form-group m-form__group col-md-6 pt-3">
            <label>اسم المندوب</label>
            {!! Form::select('user_id',$distributors,null,['class'=>'form-control m-input   select2 ','placeholder'=>' الكل'])!!}
        </div>
        <div class="form-group m-form__group  col-md-6">
            <label>   اسم المسار</label>
            {!! Form::select('route_id',[],null,['class'=>'form-control m-input select2','placeholder'=>' الكل'])!!}
        </div>

        <div class="form-group m-form__group col-md-6" >
            <label>من تاريخ</label>
            {!! Form::date('from_date',null,['class'=>'form-control m-input '])!!}
        </div>

        <div class="form-group m-form__group  col-md-6">
            <label>الى تاريخ</label>
            {!! Form::date('to_date',null,['class'=>'form-control m-input'])!!}
        </div>


    </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</div>

{{Form::close()}}
@push('scripts')
<script>

$(document).on('change','select[name="user_id"]',function(){
 
    $.ajax({
                type: 'GET',
                url: '{{ route('distributor.getAjaxRoutes') }}',
                data: {id: this.value},

                success: function (data) {
                    $('select[name="route_id"]').html(data.data);
                }
            });
})

    </script>
@endpush
