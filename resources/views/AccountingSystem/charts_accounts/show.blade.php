@extends('AccountingSystem.layouts.master')
@section('title','عرض  تفاصيل  الحساب')
@section('parent_title','  الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')
<style>
	.navbar.navbar-inverse , .footer.text-muted , .page-header-default{
		display: none !important
	}
	.content {
    padding: 20px;
}
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض {{$account->ar_name}}
                <a href="{{route('accounting.ChartsAccounts.edit',['id'=>$account->id])}}" data-toggle="tooltip" data-original-title="تعديل" class="btn btn-warning"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                <a href="#" onclick="Delete({{$account->id}})" data-toggle="tooltip" data-original-title="حذف" class="btn btn-danger">   <i class="icon-trash text-inverse "></i></a>

                {!!Form::open( ['route' => ['accounting.ChartsAccounts.destroy',$account->id] ,'id'=>'delete-form'.$account->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}
                {{-- {!! MyHelperAccountingAmount::amount($account) !!} --}}

            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">دفتر اليوميه </a></li>
              @if( $account->cost_center==1)
                <li   ><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">مركز التكلفه </a></li>
                @endif

                @if(optional($account->asset)->type =='asset')
                <li><a data-toggle="tab" role="tab" aria-controls="menu5" href="#menu5"> الاهلاك </a></li>
                 @endif
                 @if(optional($account->asset)->type=='custdoy')
                 <li><a data-toggle="tab" role="tab" aria-controls="menu6" href="#menu6"> العهد </a></li>
                 @endif
                <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> دفتر الاستاذ </a></li>
                <li class="active" ><a data-toggle="tab" role="tab" aria-controls="menu4" href="#menu4"> تفاصيل
                        الحساب </a></li>

            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="menu1" class="tab-pane  ">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th>كود </th>
                            <th>التاريخ</th>
                            <th> اسم الحساب </th>
                            <th>المبلغ</th>
                            <th>التاثير</th>

                            <th>التفاصيل</th>
                            <th>الرصيد بعد العملية</th>
                        </tr>
                        </thead>
                        <tbody>

                            @if(isset($log_openning_balance))
                                <tr  style="background:orange;">
                                    <td></td>
                                    <td></td>
                                    <td>{!! $log_openning_balance->created_at!!}</td>
                                    <td></td>

                                    <td>{!! $log_openning_balance->amount!!}</td>
                                    <td>
                                    @if($log_openning_balance->affect=='debtor')
                                        مدين <i class="fa fa-arrow-up" style="margin-left: 10px"></i>
                                    @else
                                        دائن<i class="fa fa-arrow-down" style="margin-left: 10px"></i>
                                   @endif
                                    </td>
                                    <td>
                                        رصيد افتتاحى  للحساب
                                    </td>
                                    <td>{!! $log_openning_balance->account_amount_after!!}</td>

                                </tr>

                            @endif
                        @foreach($logs as $row)
                            <tr>
                                <td>{!!$loop->iteration!!}</td>
                                <td>{!! $row->account->code!!}</td>
                                <td>{!! optional($row->entry)->date!!}</td>
                                <td>{!! $row->another_account->ar_name!!}</td>
                                <td>{!! $row->amount!!}</td>
                                <td>
                                    @if($row->affect=='debtor')
                                        مدين <i class="fa fa-arrow-up" style="margin-left: 10px"></i>
                                    @else
                                        دائن<i class="fa fa-arrow-down" style="margin-left: 10px"></i>
                                   @endif
                                </td>

                                <td>
                                    {{$row->entry->details}}
                                </td>
                                <td>
                                    {{$row->account_amount_after}}
                                </td>
                            </tr>

                        @endforeach



                        </tbody>
                    </table>

                </div>
                @if( $account->cost_center==1)
                <div role="tabpanel" id="menu2"   class=" tab-pane"  >

                    <table class="table datatable-button-init-basic">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> اسم المركز </th>

                            <th> الحالة </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($centers as $row)
                            <tr>
                                <td>{!!$loop->iteration!!}</td>
                                <td>{!! $row->center->name!!}</td>

                                <td>
                                    @if($row->active==1)
                                    مفعل
                                    @else
                                    غير مفعل
                                    @endif
                                </td>
                            </tr>

                        @endforeach



                        </tbody>
                    </table>

                </div>
                @endif
                <div role="tabpanel" id="menu3" class="tab-pane">



            <table class="table ">
                <thead>
                    <tr>
                        <th colspan="5">المدين</th>
                    </tr>
                <tr>

                    <th> # </th>
                    <th> الكود </th>
                    <th>التاريخ </th>
                    <th>المبلغ </th>
                    <th>الحساب </th>
                </tr>
                </thead>
                <tbody>

                @foreach($accountLogsForm as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->entry->code !!}</td>
                        <td>{!! $row->entry->date !!}</td>
                        <td>{!! $row->amount !!}</td>

                        <td>
                            <a href="{{route('accounting.ChartsAccounts.show',['id'=>$row->another_account->id])}}" class="link">
                                {!! $row->another_account->ar_name!!}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table ">
                <thead>
                    <tr>
                        <th colspan="5">الدائن</th>
                    </tr>
                <tr>
                    <th> # </th>
                    <th>الحساب </th>
                    <th>المبلغ </th>
                    <th>التاريخ </th>
                    <th> الكود </th>
                </tr>
                </thead>
                <tbody>

                @foreach($accountLogsTo as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>
                            <a href="{{route('accounting.ChartsAccounts.show',['id'=>$row->another_account->id])}}" class="link">
                                {!! $row->another_account->ar_name!!}
                            </a>
                        </td>
                        <td>{!! $row->amount !!}</td>
                        <td>{!! $row->entry->date !!}</td>
                        <td>{!! $row->entry->code !!}</td>




                    </tr>
                @endforeach
                </tbody>
            </table>

                </div>
                <div role="tabpanel" id="menu4"  class=" tab-pane active"  >
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>اسم الحساب باللغة العربية </label>
                        <input type="text" name="ar_name" class="form-control" value="{{$account->ar_name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>اسم الحساب باللغة الانجليزية </label>
                        <input type="text" name="en_name" class="form-control" value="{{$account->en_name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الكود </label>
                        <input type="text" name="code" class="form-control" value="{{$account->code}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label> نوع الحساب </label>
                        <select class="form-control" disabled>
                            <option selected>@if ($account->kind=='main')حساب رئيسى @elseif ($account->kind=='sub')حساب فرعى@else حساب رئيسى تابع @endif</option>
                        </select>
                    </div>
                    @if ($account->kind=='sub')
                        <div class="form-group col-sm-6 col-xs-12 pull-left">
                            <label> الحساب الرئيسى </label>
                            <select class="form-control" disabled>
                                <option selected> {{$account->account->ar_name}}</option>
                            </select>
                        </div>
                    @endif
                    @if($account->kind=='sub' )
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الرصيد الحالى بالحساب </label>
                        <input type="text" name="amount" class="form-control" value="{{$account->amount}}"    disabled>
                    </div>
                    @else
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الرصيد الحالى بالحساب </label>
                        {{-- <input type="text" name="amount" class="form-control" value="{{$account->descendants->sum('amount')}}"    disabled> --}}
                    </div>

                    @endif
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الرصيد الافتتاحى  </label>
                        <input type="text" name="openning_balance" class="form-control" value="{{$account->openning_balance}}" disabled>
                    </div>
                    <div class="form-group col-xs-6 pull-left  ">
                        <label>طبيعة الحساب </label>
                        <div class="form-line new-radio-big-wrapper">
                          <span class="new-radio-wrap">
                           <label for="Creditor">دائن </label>
                              <input type="radio" class="form-control" @if ($account->status=='Creditor') checked  @endif disabled>
                           </span>
                            <span class="new-radio-wrap">
                            <label for="debtor"> مدين </label>
                              <input type="radio" class="form-control" @if ($account->status=='debtor') checked  @endif disabled>
                            </span>
                        </div>
                    </div>



                </div>

                @if(optional($account->asset)->type == 'asset')
                <div role="tabpanel" id="menu5"  class=" tab-pane">


                       <table class="table datatable-button-init-basic">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> الكود  </th>
                                <th> تاريخ الاهلاك </th>
                                <th> اسم الحساب </th>
                                <th> مبلغ الاهلاك </th>
                                <th> القيمه بعد الاهلاك </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asset->AssetLogs as $row)
                                <tr>
                                    <td>{!!$loop->iteration!!}</td>
                                    <td>{!! $row->code!!}</td>

                                    <td>
                                        {!! $row->date!!}
                                    </td>

                                    <td>
                                        {!! $row->asset->name!!}
                                    </td>
                                    <td>
                                        {!! $row->amount!!}
                                    </td>
                                    <td>
                                        {!! $row->amount_asset_after!!}
                                    </td>
                                </tr>

                            @endforeach



                            </tbody>
                        </table>



                </div>
                @endif
                @if(optional($account->asset)->type=='custdoy')

                <div role="tabpanel" id="menu6"  class=" tab-pane">
                    <div class="awesome-card-design">

                        <h3>{!! $custody->name !!} </h3>


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                                    اضافة
                                    </button>


            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2">
             تخفيض
             </button>
                 </div>

                                    {{--<!-- Modal -->--}}
                             <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">   اضافة عهده  </h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <form method="post" action="{{route('accounting.custodies.add_amount',$custody->id)}}" id="form1">
                                                 @csrf
                                                 <label style="color:black"> المبلغ</label>
                                                 <input type="text" name="amount"  class="form-control">

                                                    <label>  اختر طريقةالدفع</label>
                                                    {!! Form::select("payment_id",$payments,null,['class'=>'form-control js-example-basic-single','id'=>'payment_id','placeholder'=>' اختر طريقةالدفع   '])!!}

                                                </form>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                             <button type="submit" class="btn btn-primary" onclick="document.getElementById('form1').submit()">اضافه  العهدة</button>
                                         </div>
                                     </div>
                                 </div>

                            </div>

                                {{--<!-- Modal -->--}}
                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">   تخفيض العهدة  </h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form method="post" action="{{route('accounting.custodies.decreased_amount',$custody->id)}}" id="form2">
                                             @csrf
                                             <label style="color:black"> المبلغ</label>
                                             <input type="text" name="amount"  class="form-control">
                                         </form>
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                         <button type="submit" class="btn btn-primary" onclick="document.getElementById('form2').submit()">تخفيض</button>
                                     </div>
                                 </div>
                             </div>
                                </div>

                    <div class="clearfix"></div>
                    <h4>عرض  عمليات العهد</h4>
                    <table class="table init-basic">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> الكود </th>
                            <th>تاريخ العهدة </th>
                            <th>اسم العملية  </th>
                            <th> المبلغ  </th>
                            <th>المبلغ بعد العملية   </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($custody->custodyLogs  as $log)
                        <tr>
                         <td>{!!$loop->iteration!!}</td>
                        <td>{!! $log->code !!}</td>
                        <td>{!! $log->date  !!}</td>
                        <td>{!! $log->operation_name  !!}</td>
                        <td>{!! $log->amount !!}</td>
                        <td>{!! $log->amount_asset_after !!}</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                @endif
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
            text: "هل تريد حذف هذا الحساب ؟",
            icon: "warning",
            buttons: ["الغاء", "موافق"],
            dangerMode: true,

        }).then(function(isConfirm){
            if(isConfirm){
                document.getElementById('delete-form'+item_id).submit();
            }
            else{
                swal("تم االإلفاء", "حذف  الحساب  تم الغاؤه",'info',{buttons:'موافق'});
            }
        });
    }
</script>
@stop
