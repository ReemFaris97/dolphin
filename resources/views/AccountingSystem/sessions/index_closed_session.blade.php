@extends('AccountingSystem.layouts.master')
@section('title','عرض  الجلسات')
@section('parent_title','إدارة  المبيعات ')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">     تاكيد اغلاق الجلسات من قبل المحاسب </h5>
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
                    <th> رقم  الجلسة </th>
                    <th>  كود الجهاز  </th>
                    <th>  اسم الوردية </th>
                    <th>  اسم الكاشير </th>
                    <th>   بداية الجلسة  </th>
                    <th>  نهايةالجلسة  </th>

                    <th>  تاكيدالاغلاق   </th>
                </tr>
                </thead>
                <tbody>

                @foreach($sessions as $key=>$row)

                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->code!!}</td>
                        <td>{!! optional($row->device)->code!!}</td>
                        <td>{!! optional($row->shift)->name!!}</td>
                        <td>{!! optional($row->user)->name!!}</td>
                        <td>{!! $row->start_session!!}</td>
                        <td>{!! $row->end_session!!}</td>


                            <td>
                                @if ($row->custody==Null)
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$row->id}}" onclick="openModal({{$row->id}})" data-target="#exampleModal{{$row->id}}" id="button{{$row->id}}">
                                      تاكيد اغلاق الجلسة
                                    </button>
                                    <label id="change{{$row->id}}"></label>
                                    @else
                                    <label class="btn-success" id="done">تم التاكيد</label>
                                @endif

                            </td>

                    </tr>

                @endforeach



                </tbody>
            </table>
        </div>

    </div>

    @foreach($sessions as $row)
       <!-- Modal -->
       <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> اغلاق  الجلسة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- {!!Form::open( ['route' => 'accounting.sessions.confirm' ,'class'=>'form phone_validate','method' => 'PATCH','files' => true]) !!} --}}
                <form id="form{{$row->id}}" >

                    <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <input type="hidden" name="session_id" class="session_id">

                    <label> عهده  الجلسه</label>
                    <input type="text" class="form-control" name="custody">
                </div>

                    <label style="color:black">الخزينة المحول  اليها </label>
{{--                    <select name="safe_id" class="form-control">--}}

{{--                        @if(isset($row->device->branch->id))--}}
{{--                        @foreach(\App\Models\AccountingSystem\AccountingSafe::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('model_id',$row->device->branch->id)->where('status','branch')->get()  as  $safe)--}}
{{--                            <option value="{{$safe->id}}">{{$safe->name}}</option>--}}
{{--                        @endforeach--}}
{{--                            @endif--}}
{{--                    </select>--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button class="btn btn-primary" id="real{{$row->id}}" type="button" data-dismiss="modal">    اضافة    عهدة الجلسة   </button>
                </div>
                </form>
                {{--{!!Form::close() !!}--}}
            </div>
        </div>
    </div>
    <!-- end model-->
@endforeach
@endsection

@section('scripts')

    <script>


      function openModal(id) {

$('.session_id').val(id);
var  token=$('#csrf_token').val();

   $(`#real${id}`).click(function (e) {
       e.preventDefault();

       $.ajax({
           type: "post",

           url: '{{route('accounting.sessions.confirm')}}',
           data:   $('#form'+id).serialize()+"&_token="+token,
           success: function (data) {
               $('#button'+id).remove();
               $("#change"+id).text('تم  تاكيد  الاغلاق');

           },error:function (data) {
               console.log(data);
           }
       });

   })

   }


    </script>
@stop
