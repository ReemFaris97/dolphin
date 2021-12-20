@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="form-group col-md-6 pull-left">
        <label> اسم المنتج المراد تصنيعه : </label>
        {!! Form::select("product_id",($product??null)?->product?->pluck('name','id')??[],null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر اسم  المنتج  ','id'=>'product_id','x-model'=>'product_id','x-ref'=>'product_id'])!!}
    </div>

    <div class="form-group col-md-6 pull-left">
        <label> الوحدة : </label>
        <select x-bind:name="`unit_id`" class="form-control"
        x-model="unit_id">
            <template x-for="unit in product_units">
                <option :value="unit.id" x-text="unit.name"></option>
            </template>
        </select>
    </div>
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

        <tr x-data="recipe(row_product)">

            <td x-text="i+1"></td>
            <td>
                <select :name="`recipes[${i}][product_id]`" class="form-control " x-ref="select"
                        x-model="selectedPro" required>
{{--                    <template x-for="product in products" :key="product.id">--}}
{{--                        <option x-bind:value="product.id" x-text="product.name"--}}
{{--                                :selected="selectedPro==product.id">--}}
{{--                        </option>--}}
{{--                    </template>--}}
                </select>
            </td>

            <td>
                <select x-bind:name="`recipes[${i}][unit_id]`" class="form-control"   >
                    <template x-for="unit in product_units" >
                        <option :value="unit.id" x-text="unit.name"></option>
                    </template>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" x-bind:name="`recipes[${i}][quantity]`"
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

