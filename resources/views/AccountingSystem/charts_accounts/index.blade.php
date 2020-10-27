@extends('AccountingSystem.layouts.master')
@section('title','عرض  الحسابات')
@section('parent_title','  الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')
<link href="{{asset('admin/assets/css/easyTree.min.css')}}" rel="stylesheet" type="text/css">


@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض  الدليل المحاسبى

            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.ChartsAccounts.create')}}" class="btn btn-success">
                    انشاء حساب  جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
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
                <li><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> شجرة الحسابات</a></li>
                <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">مراكز التكلفه </a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="menu1" class="tab-pane active">
                        <div class="easy-tree">
                            <ul>
                                {!! MyHelper::tree($accounts) !!}
                            </ul>

                        </div>
                </div>
                <div role="tabpanel" id="menu2" class="tab-pane">
                    <div class="easy-tree">
                        <ul>

                            {!! MyHelperCostCenter::treecost($accounts) !!}
                        </ul>

                    </div>
                </div>

            </div>



<!--




            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>

                    <th>اسم الحساب </th>
                    <th>كود الحساب </th>
                    <th> نوع الحساب </th>
                    <th> طبيعه  الحساب </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($accounts as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>
                            <a href="{{route('accounting.ChartsAccounts.show',['id'=>$row->id])}}" class="link">
                                {!! $row->ar_name!!}
                            </a>
                        </td>
                        <td>{!! $row->code !!}</td>
                        <td>
                            @if ($row->kind=='main')
                                رئيسى
                                @elseif($row->kind=='sub')
                                فرعى
                            @else
                                رئيسى تابع
                            @endif
                        </td>
                        <td>
                            @if ($row->status=='Creditor')
                                دائن
                            @else
                                مدين
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{route('accounting.ChartsAccounts.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.ChartsAccounts.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
-->
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
