@extends('AccountingSystem.layouts.master')
@section('title','عرض  تسوية الجرد' )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض تسوية جرد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal" id="button">
           سند الجرد
        </button>
            <div class="panel-body">
                <table class="table datatable-button-init-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> اسم الصنف   </th>
                        <th>  الكمية  </th>
                        <th> الكميه الفعليه </th>


                        <th class="text-center">النتائج</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($inventory_products as $row)
                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! $row->product->name!!}</td>

                            <td>{!! $row->quantity !!}</td>

                            <td>{!! $row->Real_quantity!!}</td>



                            <td class="text-center">
                                @if ($row->quantity > $row->Real_quantity)

                                    <label class="btn btn-danger">قيمه العجز بالمخزن ={!! $row->quantity - $row->Real_quantity!!}</label>
                               @elseif($row->quantity < $row->Real_quantity)
                                    <label class="btn btn-success">قيمه الزياده بالمخزن ={!! $row->Real_quantity - $row->quantity!!}</label>
                                @else
                                    <label class="btn btn-warning"> الكميات  متساويه</label>

                                @endif

                            </td>
                        </tr>

                    @endforeach



                    </tbody>
                </table>
            </div>


        </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> اضافه   سند جرد </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--{!!Form::open( ['route' => 'accounting.inventory_settlement.store' ,'class'=>'form phone_validate','method' => 'PATCH','files' => true]) !!}--}}
                <form id="form1"  action="{{route('accounting.inventory_bond.store')}}" method="post">
                    {{--<input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">--}}
@csrf
                    <div class="modal-body">
                        <input type="hidden" name="inventory_id"  value="{{$inventory->id}}">

                        <div class="col-sm-6 col-xs-6 pull-left" >
                        <div class="form-group form-float">
                        <label class="form-label"> رقم السند</label>
                        <div class="form-line">
                            <input value="<?php echo mt_rand();?>" name="bond_num" class="form-control" placeholder="رقم السند">

                        </div>
                        </div>
                        </div>

                        <div class="col-sm-6 col-xs-6 pull-left" >
                        <div class="form-group form-float">
                        <label class="form-label"> بيان السند</label>
                        <div class="form-line">
                        {!! Form::text("description",null,['class'=>'form-control','placeholder'=>'بيان السند'])!!}

                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button class="btn btn-primary" type="submit" data-dismiss="modal"  onclick="document.getElementById('form1').submit();" >  اضافة السند</button>
                    </div>
                </form>
                {{--{!!Form::close() !!}--}}
            </div>
        </div>
    </div>
    <!-- end model-->

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