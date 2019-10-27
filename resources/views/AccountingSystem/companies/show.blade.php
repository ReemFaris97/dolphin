@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات شركة'. $company->name )
@section('parent_title','إدارة الشركات')
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
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم الشركة  : </label>
                <span>{!! $company->name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  جوال الشركة  : </label>
                <span>{!! $company->phone !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  ايميل الشركة  : </label>
                <span>{!! $company->email !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  صورة الشركة  : </label>
                <span><img src="{!! getimg($company->image)!!}" style="width:100px; height:100px"> </span>
            </div>
            <h4>عرض الفروع</h4>
            <div class="form-group col-md-6 pull-left">

                    {{--<a href="{{route('accounting.branches.show',$branch->id)}}"> <span>-{!! $branch->name !!}</span></a><br>--}}
                    <table class="table init-basic">
                        <thead>
                        <tr>
                            <th>اسم الفرع </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches  as $branch)
                            <tr>
                        <td><a href="{{route('accounting.branches.show',$branch->id)}}">{!! $branch->name !!}</a></td>
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