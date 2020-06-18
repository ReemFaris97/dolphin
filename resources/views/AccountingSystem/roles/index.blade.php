@extends('AccountingSystem.layouts.master')
@section('title','عرض الصلاحيات')
@section('parent_title','إدارة  الصلاحيات ')
@section('action', URL::route('accounting.roles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="btn-group">
                <a href="{{route('accounting.roles.create')}}" class="btn btn-success">
                    اضافة صلاحية جديده
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
            <span>عرض كل  الصلاحيات </span>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الدور </th>
                        <th style="width: 250px;"  > العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp

                    @foreach($roles as $role)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{route('accounting.roles.edit',$role->id)}}" class="btn btn-info btn-circle"><i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i></a>
                                <a href="#"  onclick="Delete({{$role->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i></a>
                                <form method="post" action="{{route('accounting.roles.destroy',$role->id)}}" id='delete-form{{$role->id}}'>
                                    {{method_field('Delete')}}
                                    @csrf
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>



    </div>
    </div>
@endsection

