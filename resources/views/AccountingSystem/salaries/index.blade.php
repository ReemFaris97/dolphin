@extends('AccountingSystem.layouts.master')
@section('title','عرض المسميات الوظفية ')
@section('parent_title','إدارةالمسميات الوظفية ')
@section('action', URL::route('accounting.jobTitles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <form action="{{request()->fullUrl()}}">
                <div class="form-group col-sm-3">
                    <label for="month">الشهر</label>
                    <select name="month" id="month" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}" {{request('month') == $i ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="year">السنة</label>
                    <select name="year" id="year" class="form-control">
                        @for ($i = 2000; $i <= now()->year; $i++)
                            <option value="{{$i}}" {{request('year') == $i ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <input type="submit" value="{{__('trans.save')}}" class="btn btn-info">
            </form>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>المرتب</th>
                    <th>البونص</th>
                    <th>الخصومات</th>
                    <th>البدلات</th>
                    <th>السلف</th>
                    <th>الاجمالى</th>
                    <th>الاجمالى بدون السلف</th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->salary}}</td>
                        <td>{{$user->bonus}}</td>
                        <td>{{$user->discount}}</td>
                        <td>{{$user->allowance}}</td>
                        <td>{{$user->debts->sum('total_amount')}}</td>
                        <td>{{$user->total}}</td>
                        <td>{{$user->total_without_debts}}</td>
                        <td>
                            @if (!$user->is_payed && $user->salary != 0)
                                @if($user->debts->sum('total_amount') > 0)
                                    <a href="javascript:" onclick="$('.store-{{$user->id}}').submit()" class="btn btn-info">تسديد السلفة</a>
                                    <form action="{{route('accounting.salaries.store')}}" class="store-{{$user->id}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="typeable_id" value="{{$user->id}}">
                                        <input type="hidden" name="salary" value="{{$user->salary}}">
                                        <input type="hidden" name="bonus" value="{{$user->bonus}}">
                                        <input type="hidden" name="discount" value="{{$user->discount}}">
                                        <input type="hidden" name="allowance" value="{{$user->allowance}}">
                                        <input type="hidden" name="total" value="{{$user->total}}">
                                        <input type="hidden" name="debts" value="payed">
                                        <input type="hidden" name="date" value="{{$date}}">
                                        <input type="hidden" name="debts_object" value="{{json_encode($user->debts)}}">
                                    </form>

                                    <a href="javascript:" onclick="$('.store--{{$user->id}}').submit()" class="btn btn-info">دفع الشهر</a>
                                    <form action="{{route('accounting.salaries.store')}}" class="store--{{$user->id}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="typeable_id" value="{{$user->id}}">
                                        <input type="hidden" name="salary" value="{{$user->salary}}">
                                        <input type="hidden" name="bonus" value="{{$user->bonus}}">
                                        <input type="hidden" name="discount" value="{{$user->discount}}">
                                        <input type="hidden" name="allowance" value="{{$user->allowance}}">
                                        <input type="hidden" name="total" value="{{$user->total_without_debts}}">
                                        <input type="hidden" name="debts" value="not_payed">
                                        <input type="hidden" name="date" value="{{$date}}">
                                    </form>
                            @else
                                تم الدفع
                            @endif
                        @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('scripts')

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذة  الضريبة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الضريبة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
