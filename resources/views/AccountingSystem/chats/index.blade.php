@extends('AccountingSystem.layouts.master')
@section('title','عرض  المحادثات')
@section('parent_title','إدارة  الضرائب ')
@section('action', URL::route('accounting.taxs.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل المحادثات
            </h5>
        </div>

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المورد </th>
                    <th> اسم الشركة المورد لها  </th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($chats as $chat)
                    <tr>
                        <td>{{$chat->id}}</td>
                        <td>{{ $chat->supplier->name}}</td>
                        <td>{{$chat->company->name }}</td>



                        <td class="text-center">
                            <a href="{{route('accounting.chats.show',$chat->id)}}" data-toggle="tooltip" data-original-title="المحادثة"> <i
                                    class="icon-envelop text-inverse" style="margin-left: 10px"></i> </a>


                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('scripts')

@stop
