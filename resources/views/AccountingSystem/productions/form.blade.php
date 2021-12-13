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
{{--    <select name="company_id" id="company_id" class="form-control js-example-basic-single" required>--}}
{{--        <option selected disabled>اختر اسم الشركة</option>--}}
{{--        @foreach($companies as $index=>$company)--}}
{{--            <option value="{{$index}}" {{old('company_id') ==$index ? 'selected':''}}>{{$company}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
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


<button class="btn btn-success" type="button" x-on:click="addItem">اضافة صنف
</button>
<br>
<br>
<table class="table finalTb  table-responsive table-hover table-stripe">
    <thead>
    <tr>
        <th width="20">#</th>
        <th>اسم الصنف</th>
        <th>الوحدة  </th>
        <th>الكمية</th>
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    <template x-for="(row_product,i) in row_products" :key="i">
        <tr x-data=""
            x-init="$watch('row_product.product_id', product_id =>{
             let selected_product= products.find((product)=>product.id==product_id)
             row_product.buying_price=selected_product.buying_price;
            })">

            <td x-text="i+1"></td>
            <td>
                <select :name="`products[${i}][product_id]`" class="form-control "
                        x-model="row_product.product_id"  required>
                    <template x-for="product in products" :key="product.id">
                        <option x-bind:value="product.id" x-text="product.name"
                                :selected="row_product.product_id==product.id" >
                        </option>
                    </template>
                </select>
            </td>

            <td>
                <select x-bind:name="`products[${i}][unit_id]`" class="form-control" required
                        :value="typeof product == 'object'? row_product.unit_id:null">
                    <option disabled selected>اختر</option>
                    @foreach($units as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
                @error('products.*.unit_id')
                <div class="invalid-feedback" style="color: #ef1010">
                    {{ $message }}
                </div>
                @enderror
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
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

