@extends('AccountingSystem.layouts.master')
@section('title','المحادثات مع المورد')
@section('parent_title','إدارة  الموردين')
@section('action', URL::route('accounting.suppliers.index'))

@section('styles')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">المحادثات مع المورد

            </h5>

        </div>

        <div class="panel-body" id="chat">

            <chat chat="{{$chat->id}}"/>
        </div>

    </div>

@endsection


@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>

@stop
