@extends('AccountingSystem.layouts.master')
@section('title','  عرض    الخزينة ')
@section('parent_title','إدارة  الخزائن')

@section('action', URL::route('accounting.safes.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض  بيانات الخزينة </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم الخزنة  : </label>
                <span>{!! $safe->name !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> نوع  الخزنه  : </label>
              @if ($safe->status=='cashier')
                    <span>كاشير</span>

                  @elseif($safe->status=='branch')
                    <span>فرع</span>
                  @else
                    <span>شركه</span>

                @endif

            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  الرصيد الفعلى  : </label>
                <span>{!! $safe->amount??0 !!}</span>
            </div>


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$safe->id}}">
                 تحويل الى  خزينه  اخرى
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$safe->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> تحويل مالى </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('accounting.transactionsafe_store',$safe->id)}}"
                                  id="form{{$safe->id}}">
                                @csrf

                                <input type="hidden" name="safe_form_id" value="{{$safe->id}}">

                                <label style="color:black">الخزينة المنقول اليها </label>
                                <select name="safe_to_id" class="form-control">

                                        @foreach($safes  as  $saf)
                                            <option value="{{$saf->id}}">{{$saf->name}}</option>
                                        @endforeach

                                </select>

                                <label style="color:black"> المبلغ</label>
                                <input type="text" name="amount" class="form-control">
                                <label style="color:black"> ملاحظات</label>
                                <input type="textarea" name="notes" class="form-control">
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary"
                                    onclick="document.getElementById('form{{$safe->id}}').submit()">تحويل
                            </button>
                        </div>
                    </div>
                </div>
            </div>






            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>

                    <th>   رقم الخزينة  المحول اليها  </th>
                    <th>   نوع الخزينة  المحول اليها  </th>
                    <th> المبلغ  </th>

                    <th> بيان التحويل   </th>

                    <th> تاريخ التحويل   </th>
                    <th> القائم بالتحويل   </th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->getSafeTo->name !!}</td>
                        <td>
                            @if ($row->getSafeTo->status=='cashier')
                                <span>كاشير</span>

                            @elseif($row->getSafeTo->status=='branch')
                                <span>فرع</span>
                            @else
                                <span>شركه</span>

                            @endif
                        </td>

                        <td>
                           {!!  $row->amount!!}
                        </td>


                        <td>{!! $row->notes!!}</td>
                      <td>{!! date($row->created_at)!!}</td>

                        <td>{!! $row->user->name??''!!}</td>
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
