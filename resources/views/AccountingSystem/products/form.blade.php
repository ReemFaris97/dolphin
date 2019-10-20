@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="form-group col-md-6 pull-left">
    <label> اسم الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له الوجه '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> اسم الفرع التابع </label>
    {!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له الوجه '])!!}
</div>

<div class="form-group col-md-6 pull-left" id="store_id">
    <label> اسم المخزن </label>
    {!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single','id'=>'store_id','placeholder'=>' اختر اسم الشركة التابع له الوجه '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>اسم المنتج </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم المنتج  '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> اسم التصنيف </label>
    {!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له الوجه '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>النوع </label>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" id="components_button">
        المكونات
    </button>
    {!! Form::select("type",['store'=>'مخزون','service'=>'خدمه','offer'=>'مجموعة منتجات ','creation'=>'تصنيع','product_expiration'=>'منتج بتاريخ صلاحيه'],null,['class'=>'form-control js-example-basic-single','placeholder'=>'  نوع المنتج   ','id'=>'type'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>وصف المنتج </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'  وصف المنتج  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>مفعل </label>
    {!! Form::radio("is_active",1,['class'=>'form-control'])!!}

    <label>غير مفعل </label>
    {!! Form::radio("is_active",0,['class'=>'form-control'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        الوحدات الفرعية
    </button>

    {!! Form::text("main_unit",null,['class'=>'form-control','placeholder'=>'  الوحدة الاساسية '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الباركود </label>
    {!! Form::text("bar_code",null,['class'=>'form-control','placeholder'=>' الباركود '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>سعر البيع </label>
    {!! Form::text("selling_price",null,['class'=>'form-control','placeholder'=>'  سعر البيع   '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>سعر الشراء </label>
    {!! Form::text("purchasing_price",null,['class'=>'form-control','placeholder'=>'سعر الشراء  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الحد الادنى من الكمية </label>
    {!! Form::text("min_quantity",null,['class'=>'form-control','placeholder'=>'الحد الادنى  من الكمية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الحد الاقصى من الكمية </label>
    {!! Form::text("max_quantity",null,['class'=>'form-control','placeholder'=>' الحد الاقصى من الكمية '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الحجم </label><span style="color: #ff0000; margin-right: 15px;">  اختيارى ويكون بالسنتمتر المكعب</span>
    {!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم  '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> اللون </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("color",null,['class'=>'form-control','placeholder'=>'  اللون '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الارتفاع </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر</span>
    {!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> العرض </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر المربع</span>
    {!! Form::text("width",null,['class'=>'form-control','placeholder'=>'  العرض '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> تاريخ الانتهاء </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::date("expired_at",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>عدد أيام فترة الركود</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
</div>

<!-- unit table-->
<table id="productsTable" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th> اسم الوحده</th>
        <th>الباركود</th>

        <th>المقدارمن الوحدة الاساسية</th>
        <th>سعر البيع</th>
        <th>سعر الشراء</th>
    </tr>
    </thead>
    <tbody class="add-products">


    </tbody>
</table>

<!-- end table-->


<!-- component table-->
<table id="componentTable" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th> اسم الصنف</th>
        <th>الكمية</th>

        <th>الوحدة الاساسية</th>

    </tr>
    </thead>
    <tbody class="add-components">


    </tbody>
</table>

<!-- end table-->
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i>
        </button>
    </div>
</div>


<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">الوحدات الفرعية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <label> اسم الوحده</label>
                <input type="text" class="form-control" id="name">
                <label> باركود</label>
                <input type="text" class="form-control" id="par_code">
                <label>مقدارها بالنسبة للوحده الاساسية</label>
                <input type="text" class="form-control" id="main_unit_present">
                <label> سعرالبيع</label>
                <input type="text" class="form-control" id="selling_price">
                <label>سعر الشراء</label>
                <input type="text" class="form-control" id="purchasing_price">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <button class="btn btn-primary" id="subunit" onclick="myFun(event)">اضافة الوحده</button>

            </div>
        </div>
    </div>
</div>
<!-- end model1-->



<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> مكونات التصنيع</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <label> اسم المكون</label>
                <select class="form-control" id="component_name" >
                    <option disabled selected> إختار المكون</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}" >{{$product->name}}</option>
                    @endforeach
                </select>
                <label> الكمية</label>
                <input type="text" class="form-control"  id="component_quantity">
                <label>  الوحده الاساسية</label>
                <input type="text" class="form-control" id="main_unit">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <button class="btn btn-primary" id="subunit" onclick="myFun2(event)">اضافة المكونات للمنتج</button>

            </div>
        </div>
    </div>
</div>
<!-- end model2-->
@section('scripts')
    <script>

        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $("#components_button").hide();

        });
        var bigData = [];
var bigDataComponent=[];
        function myFun(event) {
            event.preventDefault();
            var data = {};
            data.par_code = $('#par_code').val();
            data.name = $('#name').val();
            data.main_unit_present = $('#main_unit_present').val();
            data.selling_price = $('#selling_price').val();
            data.purchasing_price = $('#purchasing_price').val();
            bigData.push(data);
            var appendProducts = bigData.map(function (product) {
                return (`
                <tr class="single-product">
                    <td>${product.name}</td>
                    <td>${product.par_code}</td>
                    <td>${product.main_unit_present}</td>
                    <td>${product.selling_price}</td>
                    <td>${product.purchasing_price}</td>
            <input type="hidden" name="name[]" value="${product.name}" >
            <input type="hidden" name="par_codes[]" value="${product.par_code}" >
            <input type="hidden"name="main_unit_present[]" value="${product.main_unit_present}" >
            <input type="hidden" name="selling_price[]" value="${product.selling_price}" >
            <input type="hidden"name="purchasing_price[]"  value="${product.purchasing_price}" >
                </tr>
                `);
            });
            console.log(appendProducts);
            $('.add-products').empty().append(appendProducts);

        }






        function myFun2(event) {
            event.preventDefault();
            var component_data = {};
            component_data.component_name = $('#component_name').val();
            component_data.component_quantity = $('#component_quantity').val();
            component_data.main_unit = $('#main_unit').val();
            bigDataComponent.push(component_data);
            var appendComponent = bigDataComponent.map(function (component) {
                return (`
                <tr class="single-product">
                    <td>${component.component_name}</td>
                    <td>${component.component_quantity}</td>
                    <td>${component.main_unit}</td>

            <input type="hidden" name="component_names[]" value="${component.component_name}" >
            <input type="hidden" name="qtys[]" value="${component.component_quantity}" >
            <input type="hidden"name="main_units[]" value="${component.main_unit}" >

                </tr>
                `);
            });
            console.log(appendComponent);
            $('.add-components').empty().append(appendComponent);

        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
    <script src="{{asset('admin/assets/js/creation.js')}}"></script>


@endsection
