@extends('AccountingSystem.layouts.master')
@section('title','عرض  الحسابات')
@section('parent_title',' ميزان المراجعة')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')
<link href="{{asset('admin/assets/css/easyTree.min.css')}}" rel="stylesheet" type="text/css">


@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">ميزان المراجعة

            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form action="" method="post" accept-charset="utf-8" >
                  @csrf
        <div class="form-group col-sm-3">
            <label for="from"> الفترة من </label>
            {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
        </div>
        <div class="form-group col-sm-3">
            <label for="to"> الفترة إلي </label>
            {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
        </div>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-success btn-block">بحث</button>
        </div>
        </form>
    </div>
        </div>
        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr  >
                    <th >#</th>
                    <th > الحساب </th>
                    <th colspan="2">الرصيد الافتتاحى </th>
                    <th colspan="2"> الحركات خلال الفتره </th>
                    <th colspan="2">   الرصيد الختامى </th>
                </tr>
                <tr>
                        <td></td>
                        <td> </td>
                       <td>مدين</td>
                        <td> دائن</td>
                        <td>مدين</td>
                        <td> دائن</td>
                        <td>مدين</td>
                        <td> دائن</td>
                </tr>
                </thead>
                <tbody>

                @foreach($accounts as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td >
                            <a href="{{route('accounting.ChartsAccounts.show',['id'=>$row->id])}}" class="link">
                                {!! $row->ar_name!!}
                            </a>
                        </td>
                    <td>
                          @if ($row->status=='debtor')
                        {{$row->descendants->sum('openning_balance')}}
                            @endif
                    </td>
                    <td>
                        @if ($row->status=='Creditor')
                      {{$row->descendants->sum('openning_balance')}}
                          @endif
                  </td>
                    <td>{{$row->logs_debtor($request)}}</td>
                    <td>{{$row->logs_creditor($request)}}</td>


                    <?php
                    $last_blalance=0
                     if($row->status=='debtor'){
                   $last_blalance=$row->descendants->sum('openning_balance')+$row->logs_debtor($request)-$row->logs_creditor($request)
                     }elseif($row->status=='Creditor'){
                    $last_blalance= $row->logs_debtor($request)-$row->descendants->sum('openning_balance')-$row->logs_creditor($request)
                     }
                    ?>


                        <td>
                                    @if( $last_blalance>0)
                                    {{ $last_blalance}}
                                    @endif
                        </td>
                        <td>
                            @if( $last_blalance< 0)
                            {{ $last_blalance}}
                            @endif
                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>

            </div>




        </div>

    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('admin/assets/js/easyTree.js')}}"></script>
    <script>
		(function ($) {
			function init() {
				$('.easy-tree').EasyTree();
			}
			window.onload = init();
		})(jQuery)
	</script>

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا الجهاز ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الجهاز  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
