@extends('AccountingSystem.layouts.master')
@section('title','عرض الاصناف')
@section('parent_title','إدارة  الاصناف')
@section('action', URL::route('accounting.products.index'))


@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض باركود المنتج  {!! $product->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>



            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading" style="background: #2ecc71">
                        <h6 class="panel-title">
                            <a data-toggle="collapse" href="#collapsible-styled-group1"> باركود المنتج</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group1" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="form-group col-md-4 pull-left" id="store_id">

                                <h3>
                                    {{$product->bar_code}}
                                    <?php echo \DNS1D::getBarcodeHTML($product->bar_code, "C39",1) ?>
                                </h3>
                            </div>

                        </div>
                    </div>
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
