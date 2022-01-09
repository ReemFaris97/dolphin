<?php

namespace App\Http\Controllers\AccountingSystem;

use App\DataTables\AccountingProductsDataTable;
use App\DataTables\AccountingSuppliersProductsDataTable;
use App\Http\Controllers\Controller;
use App\Imports\AccountingImport;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingIndustrial;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductBarcode;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductComponent;
use App\Models\AccountingSystem\AccountingProductDiscount;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use App\Models\AccountingSystem\AccountingProductOffer;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingService;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingTaxBand;
use App\Traits\Viewable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use Viewable;

    private $viewable = 'AccountingSystem.products.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccountingProductsDataTable $dataTable)
    {
        // $products =AccountingProduct::latest()->paginate(10);
        return $dataTable->render('AccountingSystem.products.index');

        // return $this->toIndex(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industrials = AccountingIndustrial::get(['name as label', 'id']);
        $units = AccountingProductMainUnit::get(['main_unit as label', 'id']);
        $branches = AccountingBranch::get(['name as label', 'id']);
        $categories = AccountingProductCategory::get(['ar_name as label', 'id']);
        $products = [];
        $taxs = AccountingTaxBand::get([\DB::raw('CONCAT(name," ",percent," %") as label'), 'id']);
        $suppliers = AccountingSupplier::get(['name as label', 'id']);
        $accounts = AccountingAccount::where('kind', 'sub')->get(['id', \DB::raw("concat(ar_name, ' - ',code) as label")]);
        $faces = AccountingBranchFace::get(['name as label', 'id']);
        $companies = AccountingCompany::get(['id', 'name as label']);
        $stores = AccountingStore::get(['id', 'ar_name as label']);
        $columns = AccountingFaceColumn::get(['id', 'name as label']);
        $cells = AccountingColumnCell::get(['id', 'name as label']);
//        $product= AccountingProduct::make();

        $product = collect(AccountingProduct::make()->getFillable())->mapWithKeys(fn($c) => [$c => null]);
        $product['name'] = session('name');
        $product['main_unit'] = session('unit');
        $product['purchasing_price'] = session('price');
        $product['expire_at'] = session('expire_at');
        $product['supplier_id'] = session('accounting_supplier_id');
        $product['company_id'] = session('accounting_company_id');

        $product['bar_code'] = array_filter([session('barcode')], fn($q) => $q != null);
//        \Arr::add($product['bar_code'],0,session('barcode'));

        $product['sub_products'] = [];
        $product['components'] = [];
        $product['sub_units'] = [];
        $product['offers'] = [];
        $product['stores'] = [];
        $product['discount'] = 0;
        $product['price_has_tax']=1;
        $offer_template = [
            'quantity' => '',
            'gift_quantity' => '',
        ];
        $unit_template = [
            'name' => null,
            'bar_code' => null,
            'main_unit_present' => null,
            'selling_price' => null,
            'purchasing_price' => null,
            'quantity' => null
        ];
        $component_temp = [
            'component_id' => null,
            'quantity' => null,
        ];
        return $this->toCreate(compact(
            'branches',
            'categories',
            'products',
            'industrials',
            'units',
            'taxs',
            'suppliers',
            'product',
            'unit_template',
            'component_temp',
            'faces',
            'companies',
            'stores',
            'columns',
            'cells',
            'offer_template',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required|string|max:191|product_name:accounting_products,name,category_id,' . $request['product_name'] . ',' . $request['category_id'],
            'en_name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:accounting_product_categories,id',
            'bar_code' => 'nullable|string|barcode_name:accounting_products,bar_code,bar_code,barcode,' . $request['bar_code'],
            'barcodes' => 'nullable|array|barcode_anther:accounting_products,bar_code,bar_code,barcode,',
            'par_codes' => 'nullable|array|barcode_unit:accounting_products,bar_code,bar_code,barcode,',
            'product_selling_price' => 'required',
            'product_purchasing_price' => 'required',
            'min_quantity' => 'required|string|numeric',
            'max_quantity' => 'required|string|numeric',
            'expired_at' => 'nullable|string|date',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'height' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,jpeg,gif,png',
            'width' => 'nullable|string',
            'num_days_recession' => 'nullable|string',
            'cell_id' => 'required',
            'type' => 'required|string',//        dd($inputs);
        ];
        $messsage = [
            'product_name.product_name' => "اسم المنتج موجود بالفعل بالتصنيف",
            'bar_code.barcode_name' => "باركود المنتج موجود مسبقا ",
            'barcodes.barcode_anther' => "باركود المنتج موجود مسبقا ",
            'par_codes.barcode_unit' => "باركود  الوحدة موجود مسبقا ",
            'type.required' => 'نوع المنتج مطلوب ادخاله',
        ];
        $this->validate($request, $rules, $messsage);

        $inputs = $request->except('image', 'main_unit_present', 'purchasing_price', 'selling_price', 'component_names', 'qtys', 'main_units');
        $inputs['name'] = $inputs['product_name'];
        $inputs['selling_price'] = $inputs['product_selling_price'];
        $inputs['purchasing_price'] = $inputs['product_purchasing_price'];
        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        if (getsetting('automatic_products') == 1) {
            $requests['account_id'] = getsetting('accounting_id_products');
        }
        $product = AccountingProduct::create($inputs);

        // if (isset($inputs['store_id'])) {
        //     $product->update([
        //         'store_id' => $inputs['store_id'],
        //     ]);
        //     AccountingProductStore::create([
        //         'store_id' => $inputs['store_id'],
        //         'product_id' => $product->id,
        //         'quantity' => $inputs['quantity'],
        //     ]);
        // }
        if (isset($request['main_unit'])) {
            $main_unit = AccountingProductMainUnit::where('main_unit', $request['main_unit'])->first();
            if (!isset($main_unit)) {
                AccountingProductMainUnit::create([
                    'main_unit' => $request['main_unit']
                ]);
            }
        }
        ///////  /// / //////subunits Arrays//////////////////////////////
        $names = collect($request['name']);
        $par_codes = collect($request['par_codes']);
        $main_unit_presents = collect($request['main_unit_present']);
        $selling_price = collect($request['selling_price']);
        $purchasing_price = collect($request['purchasing_price']);
        $quantities = collect($request['unit_quantities']);
        $units = $names->zip($par_codes, $purchasing_price, $selling_price, $main_unit_presents, $quantities);

        foreach ($units as $unit) {
            $uni = AccountingProductSubUnit::create([
                'name' => $unit['0'],
                'bar_code' => $unit['1'],
                'main_unit_present' => $unit['4'],
                'selling_price' => $unit['3'],
                'purchasing_price' => $unit['2'],
                'quantity' => $unit['5'],
                'product_id' => $product->id
            ]);


            // if (isset($inputs['store_id'])) {
            //     AccountingProductStore::create([
            //         'store_id' => $inputs['store_id'],
            //         'product_id' => $product->id,
            //         'quantity' => $unit['2'] * $unit['5'],
            //         'unit_id' => $uni->id

            //     ]);
            // }
        }
        ////////////////////components Arrays////////////////////////////////

        $component_names = collect($request['component_names']);
        $qtys = collect($request['qtys']);
        $main_units = collect($request['main_units']);
        $components = $component_names->zip($qtys, $main_units);
        foreach ($components as $component) {
            AccountingProductComponent::create([
                'name' => $component['0'],
                'quantity' => $component['1'],
                'main_unit' => $component['2'],
                'product_id' => $product->id
            ]);
        }
        /////////////////////////////barcodes_products///////////////////////////////////
        if (isset($inputs['barcodes'])) {
            $barcodes = $inputs['barcodes'];
            foreach ($barcodes as $barcode) {
                // dd($offer);
                AccountingProductBarcode::create([
                    'barcode' => $barcode,
                    'product_id' => $product->id,
                ]);
            }
        }
        /////////////////////////////offers _products///////////////////////////////////
        if (isset($inputs['offers'])) {
            $offers = $inputs['offers'];
            foreach ($offers as $offer) {
                // dd($offer);
                AccountingProductOffer::create([
                    'child_product_id' => $offer,
                    'parent_product_id' => $product->id,
                ]);
            }
        }
        ////////////////////discounts Arrays////////////////////////////////
        if (isset($request['discount_type'])) {
            if ($request['discount_type'] == 'percent') {
                AccountingProductDiscount::create([
                    'product_id' => $product->id,
                    'discount_type' => 'percent',
                    'percent' => $request['percent'],
                ]);
            } else {
                $basic_quantity = collect($request['basic_quantity']);
                $gift_quantity = collect($request['gift_quantity']);
                $qtys_discount = $basic_quantity->zip($gift_quantity);

                foreach ($qtys_discount as $discount) {
                    AccountingProductDiscount::create([
                        'quantity' => $discount['0'],
                        'gift_quantity' => $discount['1'],
                        'product_id' => $product->id,
                        'discount_type' => 'quantity',
                    ]);
                }
            }
        }
        /////////////////////product_taxs//////////////////////////////////////
        if (isset($request['tax']) & $request['tax'] == 1) {
            if (isset($request['tax_band_id'])) {
                $taxs = $request['tax_band_id'];
                foreach ($taxs as $tax) {
                    AccountingProductTax::create([
                        'product_id' => $product->id,
                        'tax_value' => AccountingTaxBand::find($tax)->percent,
                        'price_has_tax' => 1,
                        'tax_band_id' => $tax,
                        'tax' => $tax,
                    ]);
                }
            }
        }
        //////////////////////product_services////////////////////////////
        if (isset($request['service_type'])) {
            $service_type = collect($request['service_type']);
            $services_code = collect($request['services_code']);
            $services_price = collect($request['services_price']);
            $services = $services_price->zip($services_code, $service_type);

            foreach ($services as $service) {
                AccountingService::create([
                    'price' => $service['0'],
                    'code' => $service['1'],
                    'type' => $service['2'],
                    'product_id' => $product->id,

                ]);
            }
        }


        alert()->success('تم اضافة المنتج بنجاح !')->autoclose(5000);
//        return redirect()->route('accounting.products.index');
        return $this->show($product->id);
    }

    public function storeAjax(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:191',
            'en_name' => 'required|string',
            'company_id' => 'required',
            'branch_id' => 'required',
//            'store' => 'required',
            'type' => 'required|string|in:store,service,offer,creation,product_expiration',
            'category_id' => 'required|numeric|exists:accounting_product_categories,id',
            'description' => 'nullable|string',
            'main_unit'=>'required',
            'is_active'=>'required',
            'bar_code' => 'nullable|',
            'barcodes' => 'nullable|array|barcode_anther:accounting_products,bar_code,bar_code,barcode,',
            'par_codes' => 'nullable|array|barcode_unit:accounting_products,bar_code,bar_code,barcode,',
            'selling_price' => 'required',
            'purchasing_price' => 'required',
            'min_quantity' => 'required|string|numeric',
            'max_quantity' => 'required|string|numeric',
            'expired_at' => 'required_if:type,product_expiration|',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'height' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,jpeg,gif,png',
            'width' => 'nullable|string',
            'num_days_recession' => 'nullable|string',
            'cell_id' => 'required',
            'store_id'=>'required',
            'price_has_tax'=>'nullable|boolean',
            'suppliers'=>'nullable|array'
          //        dd($inputs);
        ];
        $messsage = [
            'product_name.product_name' => "اسم المنتج موجود بالفعل بالتصنيف",
            'bar_code.barcode_name' => "باركود المنتج موجود مسبقا ",
            'barcodes.barcode_anther' => "باركود المنتج موجود مسبقا ",
            'par_codes.barcode_unit' => "باركود  الوحدة موجود مسبقا ",
            'type.required' => 'نوع المنتج مطلوب ادخاله',
        ];
        $this->validate($request, $rules, $messsage);

        $inputs = $request->except('image', 'main_unit_present', 'purchasing_price', 'selling_price', 'component_names', 'qtys', 'main_units');
//        dd($inputs);
        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        if (getsetting('automatic_products') == 1) {
            $requests['account_id'] = getsetting('accounting_id_products');
        }
        $inputs['is_settlement']=1;
        $inputs['date_settlement']=now();
        $product = AccountingProduct::create($inputs);

        // if (isset($inputs['store_id'])) {
        //     AccountingProductStore::create([
        //         'store_id' => $inputs['store_id'],
        //         'product_id' => $product->id,
        //         'quantity' => $inputs['quantity'],
        //     ]);
        // }
        if (isset($request['main_unit'])) {
            $main_unit = AccountingProductMainUnit::where('main_unit', $request['main_unit'])->first();
            if (!isset($main_unit)) {
                AccountingProductMainUnit::create([
                    'main_unit' => $request['main_unit']
                ]);
            }
        }
        ///////  /// / //////subunits Arrays//////////////////////////////

        foreach ($request->sub_units as $sub_unit) {
             $product->sub_units()->UpdateOrCreate(['id' => \Arr::get($sub_unit, 'id')], [
                'name' => $sub_unit['name'],
                'bar_code' => $sub_unit['bar_code'],
                'main_unit_present' => $sub_unit['main_unit_present'],
                'selling_price' => $sub_unit['selling_price'],
                'purchasing_price' => $sub_unit['purchasing_price'],
                'quantity' => $sub_unit['quantity'],
            ]);
            // if (isset($inputs['store_id'])) {
            //     AccountingProductStore::create([
            //         'store_id' => $inputs['store_id'],
            //         'product_id' => $product->id,
            //         'quantity' => $unit->main_unit_present * $unit->quantity,
            //         'unit_id' => $unit->id

            //     ]);
            // }
        }

        ////////////////////components Arrays////////////////////////////////
        $product->suppliers()->attach($request['suppliers']);
        $component_names = collect($request['component_names']);
        $qtys = collect($request['qtys']);
        $main_units = collect($request['main_units']);
        $components = $component_names->zip($qtys, $main_units);
        foreach ($components as $component) {
            AccountingProductComponent::create([
                'name' => $component['0'],
                'quantity' => $component['1'],
                'main_unit' => $component['2'],
                'product_id' => $product->id
            ]);
        }
        /////////////////////////////barcodes_products//////////////////////////////////
        if (isset($inputs['barcodes'])) {
            $barcodes = $inputs['barcodes'];
            foreach ($barcodes as $barcode) {
                // dd($offer);
                AccountingProductBarcode::create([
                    'barcode' => $barcode,
                    'product_id' => $product->id,
                ]);
            }
        }
        /////////////////////////////offers _products///////////////////////////////////
        if (isset($inputs['offers'])) {
            $offers = $inputs['offers'];
            foreach ($offers as $offer) {
                // dd($offer);
                AccountingProductOffer::create([
                    'child_product_id' => $offer,
                    'parent_product_id' => $product->id,
                ]);
            }
        }
        ////////////////////discounts Arrays////////////////////////////////
        if (isset($request['discount_type'])) {
            if ($request['discount_type'] == 'percent') {
                AccountingProductDiscount::create([
                    'product_id' => $product->id,
                    'discount_type' => 'percent',
                    'percent' => $request['percent'],
                ]);
            } else {
                $basic_quantity = collect($request['basic_quantity']);
                $gift_quantity = collect($request['gift_quantity']);
                $qtys_discount = $basic_quantity->zip($gift_quantity);

                foreach ($qtys_discount as $discount) {
                    AccountingProductDiscount::create([
                        'quantity' => $discount['0'],
                        'gift_quantity' => $discount['1'],
                        'product_id' => $product->id,
                        'discount_type' => 'quantity',
                    ]);
                }
            }
        }
        /////////////////////product_taxs//////////////////////////////////////
        if ($request['tax_band_id']) {

            $taxs = $request['tax_band_id'];
            AccountingProductTax::where('product_id', $product->id)->delete();
            foreach ($taxs as $tax) {
                AccountingProductTax::create([
                    'product_id' => $product->id,
                    'tax_value' => AccountingTaxBand::find($tax)->percent,
                    'price_has_tax' => 1,
                    'tax_band_id' => $tax,
                    'tax' => $tax,
                ]);

            }


        }
        //////////////////////product_services////////////////////////////
        if (isset($request['service_type'])) {
            $service_type = collect($request['service_type']);
            $services_code = collect($request['services_code']);
            $services_price = collect($request['services_price']);
            $services = $services_price->zip($services_code, $service_type);

            foreach ($services as $service) {
                AccountingService::create([
                    'price' => $service['0'],
                    'code' => $service['1'],
                    'type' => $service['2'],
                    'product_id' => $product->id,

                ]);
            }
        }


//        alert()->success('تم اضافة المنتج بنجاح !')->autoclose(5000);
//        return redirect()->route('accounting.products.index');
        return response()->json(['status' => true, 'message' => 'تم الاضافة بنجاح !']);
    }


    public function subunit()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branches = AccountingBranch::pluck('name', 'id')->toArray();
        $categories = AccountingProductCategory::pluck('ar_name', 'id')->toArray();
        $product = AccountingProduct::find($id);
        $products = AccountingProduct::all();
        $storeproduct = AccountingProductStore::where('product_id', $id)->first();
        $store = AccountingStore::find(optional($storeproduct)->store_id ?? 1);
        $cells = AccountingColumnCell::all();
        $discounts =$product->discounts;
        $taxs = AccountingProductTax::where('product_id', $id)->get();
        $units = AccountingProductSubUnit::where('product_id', $id)->get();
        return $this->toShow(compact('branches', 'categories', 'product', 'store', 'cells', 'discounts', 'taxs', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $industrials = AccountingIndustrial::get(['name as label', 'id']);
        $units = AccountingProductMainUnit::get(['main_unit as label', 'id']);
        $branches = AccountingBranch::get(['name as label', 'id']);
        $categories = AccountingProductCategory::get(['ar_name as label', 'id']);
        $taxs = AccountingTaxBand::get([\DB::raw('CONCAT(name," ",percent," %") as label'), 'id']);
        $suppliers = AccountingSupplier::get(['name as label', 'id']);
        $accounts = AccountingAccount::where('kind', 'sub')->get(['id', \DB::raw("concat(ar_name, ' - ',code) as label")]);
        $faces = AccountingBranchFace::get(['name as label', 'id']);
        $companies = AccountingCompany::get(['id', 'name as label']);
        $stores = AccountingStore::get(['id', 'ar_name as label']);
        $columns = AccountingFaceColumn::get(['id', 'name as label']);
        $cells = AccountingColumnCell::get(['id', 'name as label']);
        $products = [];
        $taxs = AccountingTaxBand::get([\DB::raw('CONCAT(name," ",percent," %") as label'), 'id']);
        $suppliers = AccountingSupplier::get(['name as label', 'id']);
        $accounts = AccountingAccount::where('kind', 'sub')->get(['id', \DB::raw("concat(ar_name, ' - ',code) as label")]);
        $faces = AccountingBranchFace::get(['name as label', 'id']);
        $companies = AccountingCompany::get(['id', 'name as label']);
        $stores = AccountingStore::get(['id', 'ar_name as label']);
        $columns = AccountingFaceColumn::get(['id', 'name as label']);
        $cells = AccountingColumnCell::get(['id', 'name as label']);
//        $product= AccountingProduct::make();
        $product = AccountingProduct::find($id);
        $product->load('category.company', 'sub_units');
//        $product->load('store.model');
//        dd(json_decode($product->bar_code));
        $product['suppliers']=$product->suppliers()->pluck('accounting_suppliers    .id');
        $product['sub_products'] = AccountingProductComponent::where('product_id', $id)->get();
        $product['components'] = AccountingProductComponent::where('product_id', $id)->get();
        $product['sub_units'] = AccountingProductSubUnit::where('product_id', $id)->get();
        $product['supplier_id'] = session('accounting_supplier_id');
        $product['offers'] = $product->discounts;
        $product['tax']=$product->tax()->count()==0?0:1;
        $product['taxs']=$product->tax()->pluck('accounting_tax_bands.id');
        $offer_template = [
            'quantity' => '',
            'gift_quantity' => '',
        ];
        $unit_template = [
            'name' => null,
            'bar_code' => null,
            'main_unit_present' => null,
            'selling_price' => null,
            'purchasing_price' => null,
            'quantity' => null
        ];
        $component_temp = [
            'component_id' => null,
            'quantity' => null,
        ];
        return $this->toEdit(compact(
            'branches',
            'categories',
            'products',
            'industrials',
            'units',
            'taxs',
            'suppliers',
            'product',
            'unit_template',
            'component_temp',
            'faces',
            'companies',
            'stores',
            'columns',
            'cells',
            'offer_template',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = AccountingProduct::findOrFail($id);

        $rules = [


            'description' => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:accounting_product_categories,id',
            'bar_code' => 'nullable|string',
            'main_unit' => 'required|string',
            'selling_price' => 'sometimes',
            'purchasing_price' => 'sometimes',
            'min_quantity' => 'required|string|numeric',
            'max_quantity' => 'required|string|numeric',
            'expired_at' => 'nullable|string|date',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'height' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,jpeg,gif,png',
            'width' => 'nullable|string',
            'num_days_recession' => 'nullable|string',


        ];


        $this->validate($request, $rules);
        $requests = $request->all();

        $inputs = $request->except('image', 'bar_code', 'main_unit_present', 'purchasing_price', 'selling_price', 'component_names', 'qtys', 'main_units');
//        $inputs['name']=$inputs['name_product'];
        $inputs['selling_price'] = $inputs['product_selling_price'];
        $inputs['purchasing_price'] = $inputs['product_purchasing_price'];

        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        $product->suppliers()->attach($request['supplier_id']);

        $product->update($inputs);
//
        $product->update([
            'store_id' => $inputs['store_id'],
        ]);
        // if (isset($inputs['store_id'])) {
        //     AccountingProductStore::create([
        //         'store_id' => $inputs['store_id'],
        //         'product_id' => $product->id,
        //     ]);
        // }
//        $product->name=$inputs['name_product'];
        ///////  /// / //////subunits Arrays//////////////////////////////
        $names = collect($request['name']);
        $par_codes = collect($request['par_codes']);
        $main_unit_presents = collect($request['main_unit_present']);
        $selling_price = collect($request['selling_price']);
        $purchasing_price = collect($request['purchasing_price']);
        $quantities = collect($request['unit_quantities']);
        $units = $names->zip($par_codes, $purchasing_price, $selling_price, $main_unit_presents, $quantities);

        foreach ($units as $unit) {
            AccountingProductSubUnit::create([
                'name' => $unit['0'],
                'bar_code' => $unit['1'],
                'main_unit_present' => $unit['4'],
                'selling_price' => $unit['3'],
                'purchasing_price' => $unit['2'],
                'quantity' => $unit['5'],
                'product_id' => $product->id
            ]);
        }
        ////////////////////components Arrays////////////////////////////////
        $component_names = collect($request['component_names']);
        $qtys = collect($request['qtys']);
        $main_units = collect($request['main_units']);
        $components = $component_names->zip($qtys, $main_units);

        foreach ($components as $component) {
            AccountingProductComponent::create([
                'name' => $component['0'],
                'quantity' => $component['1'],
                'main_unit' => $component['2'],
                'product_id' => $product->id
            ]);
        }


        alert()->success('تم تعديل المنتج  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.products.index');
    }
    public function updateAjax(Request $request, $id)
    {
        $product = AccountingProduct::findOrFail($id);

        $rules = [
            'description' => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:accounting_product_categories,id',
            'bar_code' => 'required|array',
            'main_unit' => 'required|string',
            'selling_price' => 'required',
            'purchasing_price' => 'required',
            'min_quantity' => 'required|string|numeric',
            'max_quantity' => 'required|string|numeric',
            'expired_at' => 'nullable|string|date',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'height' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,jpeg,gif,png',
            'width' => 'nullable|string',
            'num_days_recession' => 'nullable|string',
            'tax'=>'required|boolean'
        ];
        $product->suppliers()->attach($request['suppliers']);

        $this->validate($request, $rules);
//        dd($request->all());

        $inputs = $request->except('image', 'main_unit_present', 'component_names', 'qtys', 'main_units');

        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        $product->update($inputs);
        // if (isset($request['store_id'])) {
        //     AccountingProductStore::create([
        //         'store_id' => $inputs['store_id'],
        //         'product_id' => $product->id,
        //     ]);
        // }

        foreach ($request->sub_units as $sub_unit) {
            $unit = $product->sub_units()->UpdateOrCreate(['id' => \Arr::get($sub_unit, 'id')], [
                'name' => $sub_unit['name'],
                'bar_code' => $sub_unit['bar_code'],
                'main_unit_present' => $sub_unit['main_unit_present'],
                'selling_price' => $sub_unit['selling_price'],
                'purchasing_price' => $sub_unit['purchasing_price'],
                'quantity' => $sub_unit['quantity'],
            ]);
        }


//        dd($request->);
        foreach ($request->offers as $offer) {
            $product->discounts()->updateOrCreate([
                'accounting_product_discounts.id'=>$offer['id']
            ], [
                'quantity'=>$offer['quantity'],
                'gift_quantity'=>$offer['gift_quantity'],
                'discount_type'=>'quantity']);
        }


        ////////////////////components Arrays////////////////////////////////
        $component_names = collect($request['component_names']);
        $qtys = collect($request['qtys']);
        $main_units = collect($request['main_units']);
        $components = $component_names->zip($qtys, $main_units);
        foreach ($components as $component) {
            AccountingProductComponent::create([
                'name' => $component['0'],
                'quantity' => $component['1'],
                'main_unit' => $component['2'],
                'product_id' => $product->id
            ]);
        }

        if ($request['tax']) {
            $product->tax()->sync($request->taxs);
        }
        return response()->json(['status' => true, 'message' => 'تم التعديل  بنجاح !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = AccountingProduct::findOrFail($id);
        $product->delete();
        alert()->success('تم حذف  المنتج بنجاح !')->autoclose(5000);
        return back();
    }


    public function destroy_subunit($id)
    {
        $product = AccountingProductSubUnit::findOrFail($id);
        $product->delete();
        alert()->success('تم حذف    الوحدة الفرعية بنجاح !')->autoclose(5000);

        return back();
    }


    public function getBranch($id)
    {

        //dd("sdfs");
        return branches($id);
    }

    public function branches_only($id)
    {

        //dd("sdfs");
        return branches_only($id);
    }

    public function getfaces($id)
    {
        $requests = \Request::all();
        $company_id =\Arr::get($requests, 'company_id');
        return faces($id, $company_id);
    }

    public function getcolums($id)
    {
        return colums($id);
    }


    public function getcells($id)
    {
        return cells($id);
    }


    public function getStores($branches)
    {
        $stores = [];
        if ($branches != 'all') {
            $branches_ids = explode(',', $branches);
            $branch = AccountingBranch::find($branches_ids[0]);
            $company_id = $branch->company_id;
            $stores_company = AccountingStore::where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->where('model_id', $company_id)->get();
            $collect1 = collect($stores_company);

            $stores_branch = [];
            foreach ($branches_ids as $branch_id) {
                $store_branch = AccountingStore::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('model_id', $branch_id)->first();
                array_push($stores_branch, $store_branch);
            }
            $collect2 = collect($stores_branch);
            $merged = $collect2->merge($collect1);
            $stores_ = $merged->all();
            $stores = collect($stores_)->filter();
        } else {
            $requests = \Request::all();

            $company_id = $requests['company_id'];

            $branches_1 = AccountingBranch::where('company_id', $company_id[0])->get();
            $stores_branch = [];
            foreach ($branches_1 as $branch) {
                $store_branch = AccountingStore::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('model_id', $branch->id)->first();

                array_push($stores_branch, $store_branch);
            }
            $collect2 = collect($stores_branch);

            $stores = collect($stores_branch)->filter();
        }
        return response()->json([
            'status' => true,
            'data' => view('AccountingSystem.products.getAjaxStores', compact('stores'))->render()
        ]);
    }


    public function getStoresbycompany($id)
    {
        $stores = [];

        $stores_company = AccountingStore::where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->where('model_id', $id)->get();

//        return $stores;
        return response()->json([
            'status' => true,
            'data' => view('AccountingSystem.products.getAjaxStores')->with('stores', $stores_company)->render()
        ]);
    }

    public function settlements_store(Request $request)
    {
        $inputs = $request->all();
        //dd($inputs['product_id']);

        $product_id = collect($request['product_ids']);
        $purchasing_price = collect($request['purchasing_price']);
        $selling_price = collect($request['selling_price']);
        $quantity = collect($request['quantity']);
        $merges = $product_id->zip($purchasing_price, $selling_price, $quantity);

        foreach ($merges as $merge) {
            $product = AccountingProduct::find($merge[0]);
            $product->update([
                'quantity' => $merge[3],
                'selling_price' => $merge[2],
                'purchasing_price' => $merge[1],
                'is_settlement' => 1,
                'date_settlement' => Carbon::now(),
                'settlement_store_id' => $request['store_id'],
            ]);
        }

        alert()->success('تم تسوية بدايه ارصده  المنتج بنجاح !')->autoclose(5000);

        return back();
    }

    public function barcode($id)
    {
        $product = AccountingProduct::find($id);
        return view('AccountingSystem.products.barcode', compact('product'));
    }

    public function importView()
    {
        return view('AccountingSystem.products.importView');
    }

    public function import()
    {
        Excel::import(new AccountingImport, request()->file('file'));

        return back();
    }

    public function print_barcode_view()
    {
        return view('AccountingSystem.products.print_barcode_view');
    }

    public function getProductsByAjax(Request $request)
    {
        $products = AccountingProduct::query()
            ->when($request->search, function ($b) use ($request) {
                return $b->where(
                    fn ($q) =>$q
                    ->where('name', 'LIKE', '%'.$request->search . '%')
                    ->orWhere('en_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search.'%')
                    ->orWhere('bar_code', 'like', "%$request->search%")
                );
            })->paginate(50);

        return response()->json([
            'status' => true,
            'has_more' => $products->hasMorePages(),
            'data' => $products,
        ]);
    }

    public function getProductsCreationByAjax(Request $request)
    {
        //  $products = AccountingProduct::query()->creation()
        $products = AccountingProduct::query()->creation()
            ->when($request->search, function ($b) use ($request) {
                return $b->where(
                    fn ($q) =>$q
                    ->where('name', 'LIKE', '%'.$request->search . '%')
                    ->orWhere('en_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search.'%')
                    ->orWhere('bar_code', 'like', "%$request->search%")
                );
            })->paginate(50);

        return response()->json([
            'status' => true,
            'has_more' => $products->hasMorePages(),
            'data' => $products,
        ]);
    }

    public function getProductPrice($id)
    {
        $product = AccountingProduct::whereId($id)->first();
        return response()->json($product->selling_price);
    }

    public function print_barcode(Request $request)
    {
        $product = AccountingProduct::whereId($request->product_id)->first();
        $printCount = $request->number;
        return view('AccountingSystem.products.print-barcode', compact('product', 'printCount'));
    }
}
