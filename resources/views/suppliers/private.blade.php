@extends('admin.layouts.app')
<style>
	html{
		overflow-y: hidden!important
	}
</style>
@section('content')
    <div  id="app">

        <private-chat :user="{{auth()->user()}}"> </private-chat>
    </div>

@endsection

