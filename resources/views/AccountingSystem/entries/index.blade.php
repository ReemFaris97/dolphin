@extends('AccountingSystem.layouts.master')
@section('title','عرض  القيود')
@section('parent_title','إداره القيود المحاسيبه')
@section('action', URL::route('accounting.entries.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض   القيود

            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.entries.create')}}" class="btn btn-success">
                    انشاء قيد  جديد
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

            <section class="filter">
                <div class="yurSections">
                    <div class="row">
                        <div class="col-xs-12">
                            {!!Form::open( ['route' => 'accounting.entries.filter' ,'class'=>'form phone_validate', 'method' => 'get','files' => true]) !!}
                            <div class="form-group col-sm-3 ">
                                <label> الكود  </label>
                                {!! Form::text("code",null,['class'=>'form-control'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label>مصدر  العمليه  </label>

                          <select class="form-control" name="source">
                              <option></option>
                              <option value="قيد يدوى">قيد يدوى</option>
                              <option value="مبيعات">مبيعات</option>
                              <option value="مشتريات">مشتريات</option>
                          </select>
                            </div>
                            <div class="form-group col-sm-3 col-xs-12 ">
                                <label> نوع  العمليه  </label>
                                {!! Form::select("type",['manual'=>'يدوى','automatic'=>'الى'],null,['class'=>'form-control'])!!}
                            </div>

                            <div class="form-group col-sm-3">
                                <label> تاريخ العملية </label>
                                {!! Form::date("date",null,['class'=>'form-control'])!!}
                            </div>
                            <div class="form-group col-sm-3 pull-right">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>


            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>

                    <th> الكود </th>
                    <th> المصدر </th>
                    <th>النوع </th>
                    <th> التاريخ </th>
                    <th> العمله </th>
                    <th> الوصف </th>
                    <th> الحالة </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($entries as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>
                            <a href="{{route('accounting.entries.show',['id'=>$row->id])}}" class="link">
                            {!! $row->code!!}
                            </a>
                        </td>
                        <td>
                            {!! $row->source!!}
                        </td>
                        <td>
                            @if ($row->type=='manual')
                                يدوى
                            @else
                                الى
                            @endif
                        </td>
                        <td>{!! $row->date!!}</td>
                        <td>{!! $row->currency!!}</td>
                        <td>{!! $row->details!!}</td>

                        <td>
                            @if ($row->status=='new')
                                جديد
                            @else
                                مرحلة
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($row->status=='new' && $row->type=='manual')
                            <a href="{{route('accounting.entries.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            @endif
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.entries.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذا القيد ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  القيد  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
