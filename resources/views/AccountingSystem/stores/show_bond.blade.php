@extends('AccountingSystem.layouts.master')
@section('title','عرض  السند رقم'.' '. $inputs['bond_num'] )
@section('parent_title','إدارة المخازن')
@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> رقم السند  {!! $inputs['bond_num'] !!}</h5>
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
                <label class="label ">تاريخ السند  : </label>
                <span>{!! $inputs['date'] !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label "> بيان  السند  : </label>
                <span>{!!  $inputs['description'] !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label ">  المخزن  : </label>
                <span>{!!  $inputs['store_id'] !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label ">  نوع السند   : </label>
                @if ($inputs['type']=='entry')
                    <span>سند ادخال</span>
                    @else
                    <span>سند صرف</span>

                @endif
            </div>

            {{--<div class="form-group col-md-6 pull-left">--}}
                {{--<label class="label ">  صورة الفرع  : </label>--}}
                {{--<span><img src="{!! getimg($branch->image)!!}" style="width:100px; height:100px"> </span>--}}
            {{--</div>--}}
            <div class="clearfix">

            </div>
            <h4>عرض الاصناف بالسند</h4>
            <div class="form-group col-md-12 pull-left">
                   <table class="table init-basic">
                       <thead>
                       <tr>
                           <th>اسم الصنف</th>
                           <th>الكميه </th>
                           <th>السعر </th>
                       </tr>
                       </thead>
                       <tbody>
                       {{--@dd($merges)--}}
                       @foreach($merges as $merge)
                           <tr>
                       <td>{!! $merge[0] !!}</td>
                       <td>{!! $merge[1] !!}</td>
                       <td>{!! $merge[2] !!}</td>
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