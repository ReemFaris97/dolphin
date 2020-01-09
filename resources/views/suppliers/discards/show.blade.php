@extends('suppliers.layouts.app')
@section('title')تفاصيل المرتجع
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['مرتجع'=>'/suppliers-discards','تفاصيل'=>'/clauses/show/'.$discard->id])
@includeWhen(isset($breadcrumbs),'suppliers.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
{{--    <div class="m-section__content">--}}
{{--        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">--}}
{{--            <div class="m-demo__preview  m-demo__preview--btn">--}}
{{--                @if(auth()->user()->hasPermissionTo('insert_numbers')&optional(optional($clause->logs->last())->created_at)->toDateString()!=date('Y-m-d'))--}}
{{--                    <a href="{{route('admin.clauses.getAddLog',$clause->id)}}" style="color: #FFF;" type="button" class="btn btn-primary">تحديث حالة</a>--}}
{{--                @endif--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <h5>إسم المستخدم</h5>
                    <h3>{{$discard->user->name}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>إسم المورد</h5>
                    <h3>{{$discard->supplier->name}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>سبب الإرجاع</h5>
                    <h3>{{$discard->reason}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>نوع السداد</h5>
                    <h3>
                        @switch($discard->return_type)
                            @case('cash')   كاش    @break
                            @case('switch')  بدل   @break
                            @case('decrease') إنقاص مديونية  @break
                        @endswitch
                    </h3>
                </div>

                <div class="col-xs-4">
                    <h5>التاريخ</h5>
                    <h3>{{$discard->date}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>إجمالي المرتجع</h5>
                    <h3>{{$discard->total()}}ريال </h3>
                </div>


            </div>
        </div>
    </div>


    {{--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*--}}
    <div class="m-portlet__head-tools">
        <h3>المنتجات المرتجعه</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>#</th>
            <th>المنتج</th>
            <th>الكمية</th>
            <th>السعر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($discard->discard_products->where('type','discard') as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->product->name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->price}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>


{{--    /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/--}}
@if($discard->retur_type == 'switch')
    <div class="m-portlet__head-tools">
        <h3>المنتجات المستبدله</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>#</th>
            <th>المنتج</th>
            <th>الكمية</th>
            <th>السعر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($discard->discard_products->where('type','switch') as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->product->name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->price}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>

@endif










@endsection


@section('scripts')
@endsection
