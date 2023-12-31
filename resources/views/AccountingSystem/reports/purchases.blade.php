@extends('AccountingSystem.layouts.master')
@section('title','تقرير المشتريات')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<style>
    .filter {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير المشتريات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <section class="filter">
                <div class="yurSections">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                {!! Form::select("branch_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!}
                        </div>
                        </div>
                    </div>
                </div>
            </section>


            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> رقم  الفاتورة </th>
                    <th> تاريخ الفاتورة </th>
                    <th> قيمة الفاتورة </th>
                    <th class="text-center td-display-none">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($purchases as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->id!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        <td>{!! $row->total!!}</td>


                        <td class="text-center td-display-none">
                            <a href="{{route('accounting.purchases.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.purchases.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('scripts')

    <script>
        $(function() {
            $(document).on('change', '#company_id', function () {
                let branchSelect = $('#branch_id');
                $.ajax({
                    url: `{{ url('accounting/ajax/branches') }}/${$(this).val()}`,
                    type: "get",
                    success (data) {
                        console.log(data);
                        branchSelect.empty();
                        branchSelect.append('<option value="">اختر الفرع</option>');
                        data.forEach( branch => {
                            branchSelect.append(`
                                <option value="${branch.id}">${branch.name}</option>
                            `);
                        });
                        branchSelect.selectpicker('refresh');
                    },
                    error (error) {
                        console.log(error)
                    }
                })
            })
        })
    </script>
@stop
