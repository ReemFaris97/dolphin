@extends('AccountingSystem.layouts.master')
@section('title','عرض مراكز التكلفة ')
@section('parent_title','إدارة   مراكز التكلفة')
@section('action', URL::route('accounting.fiscalYears.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل   مراكز التكلفة
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.costCenters.create')}}" class="btn btn-success">
                    إضافه  مراكز تكلفة جديدة
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

            <div class="easy-tree">
                <ul>
                    {!! MyHelperCostCenter_view::center($centers) !!}
                </ul>
            </div>
        </div>

            {{-- <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المركز </th>
                    <th> الكود </th>

                    <th> الحالة </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($centers as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->code!!}</td>

                        <td>
                            @if($row->active==1)
                            مفعل
                            @else
                            غير مفعل
                            @endif
                        </td>



                        <td class="text-center">
                            <a href="{{route('accounting.costCenters.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            @if ($row->active==0)
                            <a href="{{route('accounting.costCenters.active',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="  "> <i class="fa fa-close"></i></a>
                            @else
                            <a href="{{route('accounting.costCenters.dis_active',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="  "> <i class="icon-checkmark-circle" style="margin-left: 10px"></i> </a>
                        @endif
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.costCenters.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table> --}}
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

@stop
