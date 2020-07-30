@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات شركة'. $company->name )
@section('parent_title','إدارة الشركات')
@section('action', URL::route('accounting.companies.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض بيانات شركة {!! $company->name !!}</h5>
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
           		<img src="{!! getimg($company->image)!!}">
           		<h3>{!! $company->name !!}</h3>
           		<div class="card-design-contact">
           			<a href="tel:{!! $company->phone !!}"><i class="icon-mobile"></i><span>{!! $company->phone !!}</span></a>
           			<a href="mailto:{!! $company->email !!}"><i class="icon-envelop"></i><span>{!! $company->email !!}</span></a>
           		</div>
           		<div class="card-design-info">
           			 <p>
           			 	<label>الرصيد العام لخزائن الشركه : </label>
                		<span>{!! $company->getGeneralBalances() !!}</span>
           			 </p>
           			 <p>
           			 	<label>الرصيد الفعلى لخزائن الشركه  : </label>
               			<span>{!! $company->getRealBalances() !!}</span>
           			 </p>
           		</div>
           </div>

            <h4>عرض الفروع</h4>
            <div class="form-group col-md-12 pull-left">
				<ol>
					@foreach($branches  as $branch)
						<li><a class="dash-link" href="{{route('accounting.branches.show',$branch->id)}}">{!! $branch->name !!}</a></li>
					@endforeach
				</ol>
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