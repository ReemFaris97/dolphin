@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات العهدة'.' '. $custody->name )
@section('parent_title','إدارة  العهد')
@section('action', URL::route('accounting.custodies.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات العهدة  {!! $custody->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
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
                                        <h5 class="modal-title" id="exampleModalLabel"> تحويل  مالى  </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('accounting.custodies.add_amount',$custody->id)}}" id="form1">
                                            @csrf
                                            <label style="color:black"> المبلغ</label>
                                            <input type="text" name="amount"  class="form-control">
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
            <div class="form-group col-md-12 pull-left">

                   <table class="table init-basic">
                       <thead>
                       <tr>
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
                text: "هل تريد حذف هذة الشركة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
