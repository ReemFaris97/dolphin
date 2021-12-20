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
    <label> اسم الشركة   : </label>
    {!! Form::select("company_id",$companies,isset($production) ? $production->company_id:null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر اسم الشركة  ','id'=>'company_id'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label for="production_line_id">خط الانتاج التابع للشركة  :  </label>
    <select name="production_line_id" id="production_line_id" class="form-control js-example-basic-single" required>
        @isset($production)
            <option value="{{$production->production_line_id}}">{{$production->production_line->name}}</option>
        @endisset
    </select>
</div>


<button class="btn btn-success" type="button" x-on:click="addItem">اضافة مكونات
</button>
<br>
<br>
<table class="table finalTb  table-responsive table-hover table-stripe">
    <thead>
    <tr>
        <th width="20">#</th>
        <th>اسم الصنف</th>
        <th>الوحدة</th>
        <th>الكمية</th>
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>

    <template x-for="(row_product,i) in row_products" :key="i">

        <tr x-data="recipe(row_product)"

            x-init="$watch('selectedPro', product_id =>{
             let selected_product= creationProducts.find((product)=>product.product_id==product_id)
             row_product.recipe_id=selected_product.id;
            })"
        >

            <td x-text="i+1"></td>
            <td>
                <select :name="`products[${i}][product_id]`" class="form-control " x-ref="select"
                        x-model="selectedPro" required>
                    <option selected>اختر</option>
                                        <template x-for="product in creationProducts" :key="product.id">
                                            <option x-bind:value="product.product_id" x-text="product.product.name"
                                                    :selected="selectedPro==product.product_id">
                                            </option>
                                        </template>
                </select>
            </td>
            <input type="hidden"  x-bind:name="`products[${i}][recipe_id]`" x-model="row_product.recipe_id">
            <td>
                <select x-bind:name="`products[${i}][unit_id]`" class="form-control"   >
                    <template x-for="unit in product_units" >
                        <option :value="unit.id" x-text="unit.name"></option>
                    </template>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" x-bind:name="`products[${i}][quantity]`"
                       placeholder="ادخل الكمية" x-on:change="setProduct($event,i,'quantity')"
                       x-model="row_product.quantity" min="1" required>
            </td>
            <td>
                <button class="btn btn-danger" type="button" x-on:click="deleteItem(i)">حذف</button>
            </td>
        </tr>
    </template>
    </tbody>
</table>
<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i>
        </button>
    </div>
</div>





{{--<button class="btn btn-success mt-3" type="button" id="addProduct"> اضافة صنف--}}
{{--</button> <button class="btn btn-danger" type="button" id="removeProduct">حذف</button>--}}
{{--<br>--}}
{{--<br>--}}
{{--<div class="row productRow">--}}
{{--    <div class="form-group col-md-4 col-sm-6 col-xs-12">--}}
{{--        <label>اختر الصنف </label>--}}
{{--        {!! Form::select("products[product_id]",$products,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر اسم  المنتج  ','id'=>'product_id'])!!}--}}
{{--    </div>--}}

{{--    <div class="form-group col-md-4 col-sm-6 col-xs-12">--}}
{{--        <label>الوحدة</label>--}}
{{--        <select name="products[unit_id]" id="unit_id" class="form-control js-example-basic-single" required>--}}
{{--        </select>--}}
{{--    </div>--}}

{{--    <div class="form-group col-md-4 col-sm-6 col-xs-12">--}}
{{--        <label>الكمية  </label>--}}
{{--        {!! Form::number('products[quantity]', null, ['class' => 'form-control', 'placeholder' => 'الكمية','required']) !!}--}}
{{--    </div>--}}
{{--</div>--}}


{{--<div class="text-center col-md-12">--}}
{{--    <div class="text-right">--}}
{{--        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>--}}
{{--    </div>--}}
{{--</div>--}}

