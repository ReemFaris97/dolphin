@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات امر التصنيع رقم'.' '. $production->id )
@section('parent_title','إدارة   التصنيع')
@section('action', URL::route('accounting.productions.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض بيانات امر التصنيع رقم {!! $production->id !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="awesome-card-design">
                @include('AccountingSystem.productions.update_status')
            </div>
            <div class="awesome-card-design">
                <div class="card-design-info">
                    <p>
                        <label> اسم الشركة : </label>
                        <span>{{$production->company->name}} </span>
                    </p>
                    <p>
                        <label> خط الانتاج : </label>
                        <span>{{$production->production_line->name}}  </span>
                    </p>
                    <p>
                        <label> حالة الامر : </label>
                        <span>{{$production->status=='new' ? 'جديد':'تم التصنيع'}}  </span>
                    </p>
                </div>
            </div>

            <div class="clearfix"></div>
            <h4>عرض المنتجات</h4>
            <div class="form-group col-md-12 pull-left">
                <table class="table init-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الوحدة</th>
                        <th>الكمية</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($production->items as $index=>$item)
                        <tr>
                            <td> {{$index+1}}</td>
                            <td> {{$item->product_recipe->product->name}}</td>
                            <td> {{$item->unit->name ?? $item->product_recipe->product->main_unit}}</td>
                            <td> {{$item->quantity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

