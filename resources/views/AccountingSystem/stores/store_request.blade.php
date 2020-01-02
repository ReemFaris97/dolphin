@extends('AccountingSystem.layouts.master')
@section('title','عرض سند التحويل')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض سند التحويل</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table class="table ">
                <thead>
                <tr>
                    <th>#</th>
                    <th> الصنف</th>
                    <th>  الكميه</th>
                    <th>التكلفه </th>
                    <th>القيمه </th>

                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>

                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->cost!!}</td>
                        <td>{!! $row->price!!}</td>

                        {{--<td>--}}
                            {{--<a href="{{route('accounting.stores.request',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>--}}

                        {{--</td>--}}

                    </tr>

                @endforeach



                </tbody>
            </table>
            @if ($request->status=="pending")
                

            <div class="text-center col-md-12">
                <div class="text-right">
                 <a href="{{route('accounting.stores.accept_request',['id'=>$request->id])}}" ><lable class="label label-success" >   قبول الاستلام</lable></a>
                   {{--<a href="{{route('accounting.stores.refused_request',['id'=>$request->id])}}" data-toggle="modal" data-target="#exampleModal" id="refused"><lable class="label label-danger"> رفض الاستلام</lable></a>--}}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        رفض الاستلام
                    </button>
                </div>
            </div>
            @endif
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">سبب رفض استلام التحويل </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!!Form::open( ['route' => ['accounting.stores.refused_request',$request->id],'class'=>'form phone_validate', 'method' => 'Post','id'=>'form1','files' => true]) !!}

                    <div class="modal-body">
                        <label>السبب</label>
                        {!! Form::textarea("refused_reason",null,['class'=>'form-control js-example-basic-single','placeholder'=>' سبب  الرفض  '])!!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button class="btn btn-primary" id="offer" type="submit" data-dismiss="modal" onclick="$('#form1').submit();"> حفظ  </button>
                    </div>
                    {!!Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end model-->
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