@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="form-group col-sm-9">
    <label for="user_id">اسم المستخدم</label>
    {!! Form::select('typeable_id', $users, null, ['class'=>'form-control js-example-basic-single','id'=>'user_id']) !!}
</div>
<a href="javascript:" onclick="getUserData()" style="margin-top:26px" data-toggle="modal" data-target="#userData" class="btn btn-info col-sm-3">عرض بيانات المستخدم</a>

<div class="modal fade" id="userData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<div class="form-group col-sm-6">
    <label for="holiday_id">نوع الاجازة</label>
    {!! Form::select('holiday_id', $holidays, null, ['class'=>'form-control','id'=>'holiday_id']) !!}
</div>
<div class="form-group col-sm-6">
    <label for="start_date">تاريخ بداية الاجازة</label>
    {!! Form::date('start_date', null, ['class'=>'form-control','id'=>'start_date']) !!}
</div>
<div class="form-group col-sm-6">
    <label for="days">المدة/أيام </label>
    {!! Form::number('days',null, ['class'=>'form-control','id'=>'days']) !!}
</div>
<div class="form-group col-sm-12">
    <label for="notes">الملاحظات</label>
    {!! Form::textarea('notes', null, ['class'=>'form-control','id'=>'notes']) !!}
</div>

<input type="hidden" name="type" value="request">




<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')

    <script>


    function getUserData(){
        var id = $('select[name="typeable_id"]').val();
        $.ajax({
            url : '/accounting/holidays-requests/get-user-data/'+id,
            success : function(data){
                var modalBody = $('#userData .modal-body');
                modalBody.empty();
                var holidays = data.holidays.map(holiday=>`<div class="col-sm-6">
                        <span class="col-sm-8">${holiday.name} : </span>
                        <span class="col-sm-4">${holiday.balance} </span>
                    </div>`)
                modalBody.append(`
                    <div class="col-sm-6">الوظيفه : ${data.role}</div>
                        <div class="col-sm-6">رصيد الاجازات :${data.holiday_balance}</div>
                    <div class="col-sm-6">الجنسيه : ${data.nationality}</div>
                    <div class="col-sm-12">الفرع : ${data.branch}</div>
                    <h2 class="text-center">رصيد الاجازات</h2>
                    `).append(holidays);
            }
        })
    }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
