@extends('AccountingSystem.layouts.master')
@section('title','عرض الخزائن')
@section('parent_title','إدارة  الخزائن ')
@section('action', URL::route('accounting.safes.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل  الخزائن </h5>
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
                    <th>  اسم  الخزنة </th>
                    <th> الرصيد الحالى  </th>
                    <th>  عهدة الخزنة  </th>
                    <th> نوع الخزنة </th>
                    <th>   الخزنه التابع له </th>
                    <th>  التحويلات </th>


                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($safes as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->amount !!}</td>
                        <td>{!! $row->custody !!}</td>
                        <td>
                            @if($row->type==1)

                           رئيسية
                           @elseif($row->type==0)
                         فرعية

                            @endif
                        </td>

                        <td>
                        @if($row->model_type=='App\Models\AccountingSystem\AccountingBranch')
                       {!! $row->branch->name!!}
                        @elseif($row->model_type=='App\Models\AccountingSystem\AccountingCompany')
                        {!! $row->company->name !!}
                        @endif
                        </td>
                        <td>
                        {{--@if($row->type==1)--}}

                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$row->id}}">--}}
                               {{--تحويل--}}
                               {{--</button>--}}

                               {{--<!-- Modal -->--}}
                        {{--<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--<div class="modal-dialog" role="document">--}}
                                {{--<div class="modal-content">--}}
                                    {{--<div class="modal-header">--}}
                                        {{--<h5 class="modal-title" id="exampleModalLabel"> تحويل  مالى  </h5>--}}
                                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                            {{--<span aria-hidden="true">&times;</span>--}}
                                        {{--</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="modal-body">--}}
                                        {{--<form method="post" action="{{route('accounting.transactionsafe_store',$row->id)}}" id="form{{$row->id}}">--}}
                                            {{--@csrf--}}

                                            {{--<input type="hidden" name="safe_form_id"  value="{{$row->id}}" >--}}

                                            {{--<label style="color:black">الخزينة المنقول اليها </label>--}}
                                            {{--<select name="safe_to_id" class="form-control">--}}
                                                {{--@foreach($safes_followed  as  $safe)--}}
                                                {{--<option value="{{$safe->id}}">{{$safe->name}}</option>--}}
                                                    {{--@endforeach--}}
                                            {{--</select>--}}

                                            {{--<label style="color:black"> المبلغ</label>--}}
                                            {{--<input type="text" name="amount"  class="form-control">--}}
                                            {{--<label style="color:black"> ملاحظات</label>--}}
                                            {{--<input type="textarea"  name="notes"  class="form-control">--}}
                                        {{--</form>--}}

                                    {{--</div>--}}
                                    {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>--}}
                                        {{--<button type="submit" class="btn btn-primary" onclick="document.getElementById('form{{$row->id}}').submit()">تحويل</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}


            {{--@endif--}}
        </td>

                        <td class="text-center">
                            {{--@if($row->type==1)--}}
                            <a href="{{route('accounting.safes.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                                {{--@endif--}}
                            <a href="{{route('accounting.safes.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.safes.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

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
                text: "هل تريد حذف هذة الخزنية ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الخزنية  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
