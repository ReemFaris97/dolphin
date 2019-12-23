@extends('AccountingSystem.layouts.master')
@section('title','عرض منتجات مخزن'.' '. $store->name )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض منتجات المخزن  {!! $store->name !!}</h5>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="products_button">
                نسخ الاصناف  بالمخزن
            </button>

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
                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>

                    <th>  الباركود </th>
                    <th> الوحده الاساسية  </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> الكميه بالمخزن  </th>
                    <th> صورة  المنتج </th>
                    <th>عرض  تفاصيل  المنتج </th>
                    <th>  نقل المنتج لمخزن اخر </th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>

                        <td>
                            @if ($row->product->type=="store")
                                مخزون
                            @elseif($row->product->type=="service")
                                خدمه
                            @elseif($row->product->type=="offer")
                                مجموعة منتجات
                            @elseif($row->product->type=="creation")
                                تصنيع
                            @elseif($row->product->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif

                        </td>
                        <td>{!! $row->product-> bar_code!!}</td>
                        <td>{!! $row-> product-> main_unit!!}</td>
                        <td>{!! $row-> product-> selling_price!!}</td>
                        <td>{!! $row-> product-> purchasing_price!!}</td>
                        <td>{!! $row->  quantity!!}</td>
                        <td><img src="{!! getimg($row->product->image)!!}" style="width:100px; height:100px"> </td>
                        <td>
                        <a href="{{route('accounting.products.show',['id'=>$row->product->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>
                        </td>

                        <td>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$row->product->id}}">
                                نقل الى مخزن
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$row->product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">نقل المنتج الى مخزن اخر</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('accounting.products.transaction',$store->id)}}" id="form{{$row->product->id}}">
                                                @csrf

                                                <input type="hidden" name="product_id"  value="{{$row->product->id}}" >

                                                <label style="color: black;"> المخزن المنقول اليه المنتج {{$row->product->name}}</label>
                                                <select name="store_to" class="form-control">
                                                    @foreach($storess  as  $stor)
                                                        <option value="{{$stor->id}}">{{$stor->ar_name}}</option>
                                                    @endforeach
                                                </select>

                                                <label style="color: black;"> الكمية</label>
                                                <input type="number"  max="{{$row->product->quantity}}"   name="quantity"   class="form-control">
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="document.getElementById('form{{$row->product->id}}').submit()">نقل</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>

     

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> نسخ الاصناف بالمخزن</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!!Form::open( ['route' => ['accounting.store_products_copy.store',$store->id] ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

                    <div class="modal-body">


                        <label> اختر المخزن المنسخ منه</label>

                        {!! Form::select("store_id",$stores,null,['class'=>'form-control js-example-basic-single','id'=>'component_name','placeholder'=>' اختر  المخزن المنسخ منه '])!!}




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button class="btn btn-primary" type="submit" data-dismiss="modal" onclick="this.form.submit()">نسخ الاصناف بالمخزن </button>

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