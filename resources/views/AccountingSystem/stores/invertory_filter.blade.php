@extends('AccountingSystem.layouts.master')
@section('title',' تسوية الجرد')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> تسوية الجرد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">

                {!!Form::open( ['route' => 'accounting.stores.inventory_filter' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

                <div class="col-sm-6 col-xs-6 pull-left" >
                    <div class="form-group form-float">
                        <label class="form-label">اختر المستودع</label>
                        <div class="form-line">
                            {!! Form::select("store_id",$stores,null,['class'=>'form-control','id'=>'example-date'])!!}

                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-xs-6 pull-left" >
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ الجرد</label>
                        <div class="form-line">
                            {!! Form::date("date",null,['class'=>'form-control','id'=>'example-date'])!!}

                        </div>
                    </div>
                </div>


                <div class="text-center col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">بحث<i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>

                {!!Form::close() !!}
            </div>
        </div>
        <!--End Page-Title -->



        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المستودع </th>
                    <th> تاريخ الجرد </th>


                    <th class="text-center">عرض</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inventories as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->store->ar_name !!}</td>
                        <td>{!! $row->date!!}</td>
                        <td class="text-center">

                            <a href="{{route('accounting.stores.inventory_details',$row->id)}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>

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
                text: "هل تريد حذف هذا الفرع ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الفرع  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
