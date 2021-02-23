@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group col-sm-6">
    <label for="typeable_id">اسم الموظف</label>
    {!! Form::select('typeable_id', $users, null, ['class'=>'form-control','id'=>'typeable_id']) !!}
</div>
<div class="form-group col-sm-6">
    <label for="type">التسجيل</label>
    {!! Form::select('type', ['in'=>'حضور','out'=>'انصراف'], null, ['class'=>'form-control','id'=>'type']) !!}
</div>
<div class="form-group col-sm-12">
    <label for="date">التاريخ</label>
    {!! Form::datetimeLocal('date', null, ['class'=>'form-control','id'=>'date']) !!}
</div>



<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();


    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
