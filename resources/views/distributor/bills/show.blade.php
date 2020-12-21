@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['عرض الفاتورة'=>'/distributor',$bill->id])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{-- {{$user->name}} --}}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">


                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                        <tr>
                            <th> المعلومه</th>
                            <th> القيمه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>رقم الفاتوره</td>
                            <td>{{$bill->invoice_number}}</td>
                        </tr>
                        <tr>
                            <td>العميل</td>
                            <td>{!!optional(optional($bill->route_trip)->client)->name  !!}</td>
                        </tr>
                        <tr>
                            <td>تاريخ الفاتوره</td>
                            <td>{{$bill->created_at}}</td>
                        </tr>
                        <tr>
                            <td> قيمةالفاتوره </td>
                            <td>{{$bill->cash }}</td>
                        </tr>
                        <tr>
                            <td>اسم المندوب </td>
                            <td>{!! optional($bill->route_trip)->route->user->name !!}</td>
                        </tr>
                        <tr>
                            <td>حالة الزيارة</td>
                            <td>
                                @if(optional(optional($bill->inventory)->type=='accept'))
                                    <label class="btn btn-success"> تم القبول</label>
                                  @else
                                      <label class="btn btn-danger"> تم الرفض</label>

                                  @endif
                            </td>
                        </tr>
                        @if(optional($bill->inventory)->type=='refuse')
                        <tr>
                            <td> سبب الرفض</td>
                            <td>

                           {{optional($bill->inventory)->refuse_reason}}
                            </td>
                        </tr>
                        @endif

                        <tr>

                        <td>صورقبل الزيارة</td>
                        <td>
                            @isset($bill->inventory->images )
                            @foreach($bill->inventory->images as $key => $image)
                            <img src="{!!asset($image->image)!!}" height="100" width="100"/>
                            @endforeach()
                            @endisset
                        </td>
                        </tr>
                        <tr>
                        <td>صور بعد الزيارة</td>
                        <td>
                            @foreach($bill->images as $key => $image)
                            <img src="{!!asset($image->image)!!}" height="100" width="100"/>
                            @endforeach()
                        </td>
                    </tr>
                        </tr>


                        </tbody>
                    </table>


                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                            <tr>
                            <th>اسم الصنف </th>
                            <th>   الكمية بالحبة</th>
                            <th>   الكمية بالعلبة</th>
                            <th> السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($bill->products as $value)
                                <tr>
                                <td>{{ $value->product->name }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>
                                    @if($value->product->quantity_per_unit != 0)
                                  {{  $value->quantity / $value->product->quantity_per_unit }}
                                    @else
                                    {{    $value->quantity / 1 }}
                                    @endif
                                    </td>
                                <td>{{ $value->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                <td  colspan="2">اجمالى عدد  الاصناف: </td>
                                <td  colspan="2">{{ $bill->products->count() }}</td>
                                </tr>
                                <tr>
                                    <td  colspan="2">اجمالى الفاتوره  : </td>
                                    <td  colspan="2">{{ $bill->cash}}</td>
                                </tr>
                                <tr>
                                    <td  colspan="2">اجمالى الموجود  : </td>
                                    <td  colspan="2" >{{ $bill->products->sum('price')}}</td>
                                 </tr>
                                 <tbody>
                    </table>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
