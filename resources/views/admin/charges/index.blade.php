@extends('admin.layouts.app')
@section('title') العهد
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=[$page_title=>'#'])
    @includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

<div class="m-portlet m-portlet--mobile">
    <div class="static-tabs">
        <a class="links-tabs-active"  href="{!! route('admin.charges.destruct.index') !!}">كل التوالف</a>
        <a   href="{!! route('admin.charges.create') !!}">اضافة عهدة  جديدة</a>
    </div>
    <div class="m-portlet__head">

        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {!! $page_title !!}
                </h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                @if(auth()->user()->hasPermissionTo('assign_charges'))

                <li class="m-portlet__nav-item">
                    <a href="{!!route('admin.charges.create')!!}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه عهدة جديدة</span>
                        </span>
                    </a>
                </li>
                <li class="m-portlet__nav-item"></li>
@endif
            </ul>
        </div>

    </div>
    <div class="m-portlet__body">
    @include('admin.charges._table')
    </div>
</div>
@endsection

@push('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.destruct', function () {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var   text = 'هل تريد إتلاف العهدة فعلا ؟';
            var   type = 'error';
            var  confirmButtonClass = 'btn-danger waves-effect waves-light';
            var   redirectionRoute = '{{route('admin.charges.index')}}';

            Swal.fire({
                title: "هل انت متأكد؟",
                text: text,
                type: type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'موافق',
                cancelButtonText: "إلغاء"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'post',
                        url :url,
                        data:{id:id},
                        dataType:'json',
                        success:function(data){
                            if(data.status == true){
                                var title = data.title;
                                var msg = data.message;
                                toastr.options = {
                                    positionClass : 'toast-top-left',
                                    onclick:null
                                };

                                var $toast = toastr['success'](msg,title);
                                $toastlast = $toast;

//                                    $tr.find('td').fadeOut(100,function () {
//                                        $tr.remove();
//                                    });

                                function pageRedirect() {
                                    window.location.href =redirectionRoute;
                                }
                                setTimeout(pageRedirect(), 750);
                            }else {
                                var title = data.title;
                                var msg = data.message;
                                toastr.options = {
                                    positionClass : 'toast-top-left',
                                    onclick:null
                                };

                                var $toast = toastr['error'](msg,title);
                                $toastlast = $toast
                            }
                        }
                    });
                }
            });


        });

        $('body').on('click', '.statusWithReason', function () {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#elementRow' + id).parent().parent());

            var  text = 'هل تريد تأكيد العهده فعلا ؟';
            var type = 'success';
            var   redirectionRoute = '{{route('admin.charges.index')}}';

            Swal.fire({
                title: "هل انت متأكد؟",
                text: text,
                type: type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'موافق',
                cancelButtonText: "إلغاء"
            }).then((result) => {
                if (result.value) {
                    $('#myModal_active').modal('show');
                    $("#activeButton").click(function (e) {
                        var code = $('#confirm_code').val();

                        $.ajax({
                            type:'post',
                            url :url,
                            data:{id:id,code:code},
                            dataType:'json',
                            success:function(data){
                                if(data.status == true){
                                    $('#myModal_active').modal('hide');
                                    var title = data.title;
                                    var msg = data.message;
                                    toastr.options = {
                                        positionClass : 'toast-top-left',
                                        onclick:null
                                    };

                                    var $toast = toastr['success'](msg,title);
                                    $toastlast = $toast;

                                   $tr.find('td').fadeOut(100,function () {
                                       $tr.remove();
                                   });

                                    function pageRedirect() {
                                        window.location.href =redirectionRoute;
                                    }
                                    setTimeout(pageRedirect(), 750);
                                }else {
                                    var title = data.title;
                                    var msg = data.message;
                                    toastr.options = {
                                        positionClass : 'toast-top-left',
                                        onclick:null
                                    };

                                    var $toast = toastr['error'](msg,title);
                                    $toastlast = $toast
                                }
                            }
                        })
                    });
                }
            });

//             swal({
//                     title: "هل انت متأكد؟",
//                     text: text,
//                     type: type,
//                     showCancelButton: true,
//                     confirmButtonColor: "#27dd24",
//                     confirmButtonText: "موافق",
//                     cancelButtonText: "إلغاء",
//                     confirmButtonClass:confirmButtonClass,
//                     closeOnConfirm: true,
//                     closeOnCancel: true,
//                 },
//                 function (isConfirm) {
//                     if(isConfirm){
//                         if(action === 'activate'){
//                             $('#myModal_active').modal('show');
//
//                             $("#activeButton").click(function(e){
//
//                                 var reason = $('#confirm_code').val();
//
//                                 $.ajax({
//                                     type:'post',
//                                     url :url,
//                                     data:{id:id,action:action,reason:reason},
//                                     dataType:'json',
//                                     success:function(data){
//                                         if(data.status == true){
//                                             var title = data.title;
//                                             var msg = data.message;
//                                             toastr.options = {
//                                                 positionClass : 'toast-top-left',
//                                                 onclick:null
//                                             };
//
//                                             $('.modal').modal('hide');
//                                             var $toast = toastr['success'](msg,title);
//                                             $toastlast = $toast;
//
//                                             function pageRedirect() {
//                                                 location.reload();
//                                             }
//                                             setTimeout(pageRedirect(), 2500);
//                                         }else {
//                                             var title = data.title;
//                                             var msg = data.message;
//                                             toastr.options = {
//                                                 positionClass : 'toast-top-left',
//                                                 onclick:null
//                                             };
//
//                                             var $toast = toastr['error'](msg,title);
//                                             $toastlast = $toast
//                                         }
//                                     }
//                                 });
//                             });
//                         }
//                         if(action === 'suspend'){
//                             $('#myModal_suspend').modal('show');
//
//                             $("#suspendButton").click(function(e){
//
//                                 var reason = $('#suspend_reason').val();
//
//                                 $.ajax({
//                                     type:'post',
//                                     url :url,
//                                     data:{id:id,action:action,reason:reason},
//                                     dataType:'json',
//                                     success:function(data){
//                                         if(data.status == true){
//                                             var title = data.title;
//                                             var msg = data.message;
//                                             toastr.options = {
//                                                 positionClass : 'toast-top-left',
//                                                 onclick:null
//                                             };
//
//                                             $('.modal').modal('hide');
//                                             var $toast = toastr['success'](msg,title);
//                                             $toastlast = $toast;
//
// //                                            $tr.find('td').fadeOut(100,function () {
// //                                                $tr.remove();
// //                                            });
//
//                                             function pageRedirect() {
//                                                 location.reload();
//                                             }
//                                             setTimeout(pageRedirect(), 2500);
//                                         }else {
//                                             var title = data.title;
//                                             var msg = data.message;
//                                             toastr.options = {
//                                                 positionClass : 'toast-top-left',
//                                                 onclick:null
//                                             };
//
//                                             var $toast = toastr['error'](msg,title);
//                                             $toastlast = $toast
//                                         }
//                                     }
//                                 });
//                             });
//                         }
//
//                     }
//
//                 }
//             );
        })

    </script>
@endpush
