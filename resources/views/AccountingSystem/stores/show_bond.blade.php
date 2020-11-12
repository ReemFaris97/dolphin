@extends('AccountingSystem.layouts.master')
@section('title','عرض  السند رقم'.' '. $bond->bond_num )
@section('parent_title','إدارة المستودعات')
@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> رقم السند  {!! $bond->bond_num !!}</h5>
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
           		
           		<div class="card-design-info">
           			<p>
           					<label>  نوع السند   : </label>
						@if ($bond->type=='entry')
							<span>سند ادخال</span>
							@else
							<span>سند صرف</span>
						@endif
           			</p>
					<p>
						<label>تاريخ السند  : </label>
						 <span>{!! $bond->date !!}</span>
					</p>
          			 @if ($bond->type=='entry'||$bond->type == 'exchange')
           			 <p>
           			 	<label>المستودع :  </label>
                		<span>{!!  $bond->store->ar_name !!}</span>
           			 </p>
           			 @else
           			 <p>
           			 	<label>  المستودع المحول منه : </label>
               			<span>{!! optional($bond->getStoreFrom)->ar_name !!}</span>
           			 </p>
           			 <p>
           			 	<label>  المستودع المحول إليه :   </label>
               			<span>{!!  optional($bond->getStoreTo)->ar_name !!}</span>
           			 </p>
           			 @endif
           		</div>
          		<div class="card-design-info">
           			 <p>
           			 	<label> بيان السند : </label>
                		<span>{!! $bond->description !!}</span>
           			 </p>
           		</div>
           </div>
            <div class="clearfix"></div>
            <h4>عرض الاصناف بالسند</h4>
            <div class="form-group col-md-12 pull-left">
                   <table class="table init-basic">
                       <thead>
                       <tr>
                           <th>اسم الصنف</th>
                           <th>الكميه </th>
                           <th>السعر </th>
                       </tr>
                       </thead>
                       <tbody>
                       {{--@dd($merges)--}}
                       @foreach($bondproducts as $product)
                           <tr>
                       <td>
                       {{$product->product->name}}
                       </td>
                       <td>{{$product->quantity}}</td>
                       <td>{{$product->price}}</td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>

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