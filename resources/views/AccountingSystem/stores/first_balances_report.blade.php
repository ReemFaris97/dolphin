@extends('AccountingSystem.layouts.master')
@section('title',' تقرير  ارصده اول مده ')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> تقرير  ارصده اول مده</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">

                {!!Form::open( ['route' => 'accounting.stores.balances_filter' ,'id'=>'form','class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}



                <div class="form-group">
                    <label class="display-block text-semibold"> عرض  التقرير بالنسبة الى </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" class="styled" value="0"  onclick="myFunction()" checked>
                        فرع
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status"  class="styled" value="1" onclick="myFunction1()"  >
                        مستودع
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status"  class="styled" value="2" onclick="myFunction2()"  >
                        المؤسسة
                    </label>
                </div>



                <div class="col-sm-6 col-xs-6 pull-left branch" >
                    <div class="form-group form-float">
                        <label class="form-label">اختر الفروع</label>
                        <div class="form-line">

                            {!! Form::select("branch_id[]",$branches,null,['class'=>'form-control selectpicker js-example-basic-single branch_id','multiple','id'=>'branch_id','placeholder'=>' اختر  الفروع'])!!}

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-6 pull-left store" >
                    <div class="form-group form-float">
                        <label class="form-label">اختر المستودع</label>
                        <div class="form-line">
                            {!! Form::select("store_id[]",$stores,null,['class'=>'form-control selectpicker js-example-basic-single store_id','multiple','id'=>'store_id','placeholder'=>' اختر  المستودعات'])!!}

                        </div>
                    </div>
                </div>


                <div class="form-group col-md-6 pull-left">
                    <label> اسم الصنف </label>
                    {!! Form::select("product_id",$allproducts,null,['class'=>'form-control js-example-basic-single','id'=>'industrial_id','placeholder'=>' اختر اسم المنتج '])!!}
                </div>

                <div class="form-group col-md-6 pull-left">
                    <label> تاريخ  البدايه </label>
                    {!! Form::date("date",null,['class'=>'form-control'])!!}
                </div>




                <div class="text-center col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">بحث<i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>

                {!!Form::close() !!}
            </div>
        </div>

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>

                    <th> اسم الصنف  </th>
                    <th> الباركود </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> الكميه  </th>

                </tr>
                </thead>
                <tbody >
                <tr class="balances">

                </tr>


                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('scripts')
    <script>

        $(document).ready(function() {
            $(".store").hide();
        });

      function myFunction() {
          $(".store").hide();
          $(".branch").show();
      }

      function myFunction1() {
          $(".branch").hide();
          $(".store").show();

      }
      function myFunction2() {
          $(".store").hide();
          $(".branch").hide();

      }
    </script>



    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>

        $("#form").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url:'{{route('accounting.stores.balances_filter')}}',
                data: form.serialize(),
                success: function(data)
                {


                    $('.balances').html(data.product);

                },

            });
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@stop