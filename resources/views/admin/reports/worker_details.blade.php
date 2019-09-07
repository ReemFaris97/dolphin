@extends('admin.layouts.app')
@section('title') تقرير الموظف
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['التقارير'=>"",])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">

            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        تفاصيل التقرير
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('admin.workerSearchForm')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>رجوع للبحث</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>

        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->


            {{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>إسم المهمة</th>
                    <th>‫تقييم المهمة بناء على وقت الإنجاز</th>
                    <th>تقيم المشرف للمهمه</th>
                    <th>اسم الموظف</th>
                    <th>اسم منشئ المهمه</th>
                    <th>اسم القائم على الانهاء</th>
                    <th>وقت الانتهاء</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! optional($row->task)->name !!}</td>
                        <td>{!! $row->finishing_rate !!}</td>
                        <td>{!! $row->rate !!}</td>
                        <td>{!! optional($row->user)->name !!}</td>
                        <td>{!! optional(optional($row->task)->creator)->name !!}</td>
                        <td>{!! optional($row->finisher)->name !!}</td>
                        <td>{!! optional($row->finished_at)->format('Y-m-d h:i A') !!}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection
