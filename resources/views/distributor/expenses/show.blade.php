@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['عرض بيانات المصروف'=>'/distributor',$expense->id ])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    عرض بيانات المصروف {!!$expense->sanad_No!!}
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
                    <td>  رقم سندالمصروف </td>
                    <td>{{$expense->sanad_No}}</td>
                </tr>
                <tr>
                    <td> اسم بند المصروف</td>
                    <td>{{$expense->clause->name}}</td>
                </tr>

                <tr>
                    <td> نوع المصروف </td>
                    <td>{{$expense->type->name}}</td>
                </tr>
                <tr>
                    <td> اسم المندوب </td>
                    <td>{{$expense->distributor->name ??''}}</td>
                </tr>

                <tr>
                    <td> البريد الإلكتروني
                    </td>
                    <td>{{$expense->email }}</td>
                </tr>

                <tr>
                    <td>
                        تاريخ ووقت المصروف
                    </td>
                    <td>{{$expense->date  }}-{{ $expense->time}}</td>
                </tr>

                <tr>
                    <td>
                             صورة المصروف
                    </td>
                    <td>
                        @if($expense->image)
                            <img src="{!!asset($expense->image)!!}" height="100" width="100" />
                        @else
                            لا يوجد صوره للمصروف
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                                المبالغ النقدية
                    </td>
                    <td>{{$expense->amount }}</td>
                </tr>

                <tr>
                    <td>
                        اسم العداد

                    </td>
                    <td>{{$expense->reader->name }}</td>
                </tr>
                <tr>
                    <td>
                        قراءة العداد
                    </td>
                    <td>{{$expense->reader_number }}</td>
                </tr>
                <tr>
                    <td>
                        الملاحظات
                    </td>
                    <td>{{$expense->notes }}</td>
                </tr>  <tr>
                    <td>
                        رقم التكرار
                    </td>
                    <td>{{$expense->round }}</td>
                </tr>
                <tr>
                    <td>
                        اسم المسار
                    </td>
                      <td>{{$expense->distributor_route->name??'' }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


@endsection


@section('scripts')
@endsection
