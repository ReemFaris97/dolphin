@extends('AccountingSystem.layouts.master')
@section('title','عرض   اصناف تالفه ل'.' '. $damage->store->ar_name )
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض   اصناف تالفه ل  {!! $damage->store->ar_name!!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {{--<div class="form-group col-md-6 pull-left">--}}
                {{--<label class="label label-info"> رقم السند : </label>--}}
                {{--<span>{!! isset($inventory->bond_num)?$inventory->bond_num: ""  !!}</span>--}}
            {{--</div>--}}


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم المستودع   : </label>
                <span>{!! optional($damage->store)->ar_name !!}</span>
            </div>



            {{--<div class="form-group col-md-6 pull-left">--}}
                {{--<label class="label label-info">  اسم القائم بالجرد : </label>--}}
                {{--<span>{!! $inventory->user->name !!}</span>--}}
            {{--</div>--}}

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> تاريخ
                    : </label>
                <span>{!! $damage->created_at !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> عدد الاصناف التالفه
                    : </label>
                <span>{!! $damage->productCount() !!} </span>
            </div>



            <div class="clearfix">

            </div>

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    {{--<th> نوع المنتج </th>--}}

                    <th>  الباركود </th>
                    <th> الكميه التالفه  </th>


                </tr>
                </thead>
                <tbody>

                @foreach($damage_products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>


                        <td>{!! $row->product-> bar_code!!}</td>

                        <td>{!! $row->quantity!!}</td>



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