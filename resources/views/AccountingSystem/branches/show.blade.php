@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات فرع'.' '. $branch->name )
@section('parent_title','إدارة فروع الشركات')
@section('action', URL::route('accounting.branches.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات الفرع  {!! $branch->name !!}</h5>
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
                <div class="row align-center">
                    <div class="col-md-6">
                        <img src="{!! getimg($branch->image)!!}">
                        <h3 class="title-size">{!! $branch->name !!} ( {!! $branch->company->name !!} )</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="card-design-contact align-right">
                            <a href="tel:{!! $branch->phone !!}"><div><i class="icon-mobile"></i></div><span>{!! $branch->phone !!}</span></a>
                            <a href="mailto:{!! $branch->email !!}"><div><i class="icon-envelop"></i></div><span>{!! $branch->email !!}</span></a>
                        </div>
                    </div>
                </div>
           </div>
           <div class="awesome-card-design mt-card">
           		
           		<div class="card-design-info">
           			 <p>
           			 	<label> الرصيد العام لخزائن الفرع : </label>
                		<span>{!! $branch->getGeneralBalances() !!}</span>
           			 </p>
           			 <p>
           			 	<label>  الرصيد الفعلى لخزائن الفرع  :  </label>
               			<span>{!! $branch->getRealBalances() !!}</span>
           			 </p>
           		</div>
           </div>
            <div class="clearfix"></div>
            <h4>عرض الورديات بالفرع</h4>
            <div class="form-group col-md-12 pull-left">

                   <table class="table init-basic">
                       <thead>
                       <tr>
                           <th>اسم الوردية </th>
                           <th>من </th>
                           <th>الى </th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($shifts  as $shift)
                       <tr>
                       <td>{!! $shift->name !!}</td>
                       <td>{!! $shift->from !!}</td>
                       <td>{!! $shift->to !!}</td>
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