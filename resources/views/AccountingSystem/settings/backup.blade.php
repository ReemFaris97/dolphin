@extends('AccountingSystem.layouts.master')

@section('title','  الاعدادت')
@section('content')

    <!-- Page-Title -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">   اعدادت النظام  </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
    <!--End Page-Title -->

    <div class="panel-body">


                <h4 class="header-title m-t-0 m-b-30">Administer Database Backups</h4>

        <div class="row">
            <div class="col-xs-12 clearfix">
                <a id="create-new-backup-button" href="{{route('accounting.backups.create')}}" class="btn btn-primary pull-right"
                   style="margin-bottom:2em;"><i
                        class="fa fa-plus"></i> Create New Backup
                </a>
            </div>
                <table id="datatable-buttons" class="table datatable-button-init-basic" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <tr>
                        <th>File</th>
                        <th>Size</th>
                        <th>Date</th>
                        <th>Age</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ humanFilesize($backup['file_size']) }}</td>
                            <td>
                                {{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia (T)') }}
                            </td>
                            <td>
                                {{ diffTimeStamp($backup['last_modified']) }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-default"
                                   href="{{ url('backup/download/'.$backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i> Download</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                    Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    @endsection

    @section('scripts')

        <!-- DataTables -->

            <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css')}}"></script>
            <script src="{{asset('admin/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css')}}"></script>
            <script src="{{asset('admin/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css')}}"></script>
            <script src="{{asset('admin/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css')}}"></script>
            <script src="{{asset('admin/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css')}}"></script>


            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            </script>
            <script>

                $('body').on('click', '.removeElement', function () {
                    var id = $(this).attr('data-id');
                    var url = $(this).attr('data-url');
                    var tr = $(this).closest($('#elementRow' + id).parent().parent());

                    swal({
                            title: "هل انت متأكد؟",
                            text: 'هل تريد حذف المستخدم فعلا ؟',
                            type: "error",
                            showCancelButton: true,
                            confirmButtonColor: "#27dd24",
                            confirmButtonText: "موافق",
                            cancelButtonText: "إلغاء",
                            confirmButtonClass:"btn-danger waves-effect waves-light",
                            closeOnConfirm: true,
                            closeOnCancel: true,
                        },
                        function (isConfirm) {
                            if(isConfirm){
                                $.ajax({
                                    type:'delete',
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



                                            tr.find('td').fadeOut(1000, function () {
                                                tr.remove();
                                            });

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

                        }
                    );
                });

            </script>

            <script>

                $('body').on('click', '.statusWithReason', function () {
                    var id = $(this).attr('data-id');
                    var url = $(this).attr('data-url');
                    var $tr = $(this).closest($('#elementRow' + id).parent().parent());
                    var action = $(this).attr('data-action');
                    var text = '';
                    var type = '';
                    var confirmButtonClass = '';
                    var redirectionRoute = '';

                    //  Modal data ....
                    if(action === 'suspend'){
                        text = 'هل تريد حظر المستخدم فعلا ؟';
                        type = 'error';
                        confirmButtonClass = 'btn-danger waves-effect waves-light';


                    }if(action === 'activate'){
                        text = 'هل تريد تفعيل المستخدم فعلا ؟';
                        type = 'success';
                        confirmButtonClass = 'btn-success waves-effect waves-light';

                    }

                    swal({
                            title: "هل انت متأكد؟",
                            text: text,
                            type: type,
                            showCancelButton: true,
                            confirmButtonColor: "#27dd24",
                            confirmButtonText: "موافق",
                            cancelButtonText: "إلغاء",
                            confirmButtonClass:confirmButtonClass,
                            closeOnConfirm: true,
                            closeOnCancel: true,
                        },
                        function (isConfirm) {
                            if(isConfirm){
                                if(action === 'activate'){
                                    $('#myModal_active').modal('show');

                                    $("#activeButton").click(function(e){

                                        var reason = $('#activate_reason').val();

                                        $.ajax({
                                            type:'post',
                                            url :url,
                                            data:{id:id,action:action,reason:reason},
                                            dataType:'json',
                                            success:function(data){
                                                if(data.status == true){
                                                    var title = data.title;
                                                    var msg = data.message;
                                                    toastr.options = {
                                                        positionClass : 'toast-top-left',
                                                        onclick:null
                                                    };

                                                    $('.modal').modal('hide');
                                                    var $toast = toastr['success'](msg,title);
                                                    $toastlast = $toast;

                                                    function pageRedirect() {
                                                        location.reload();
                                                    }
                                                    setTimeout(pageRedirect(), 2500);
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
                                    });
                                }
                                if(action === 'suspend'){
                                    $('#myModal_suspend').modal('show');

                                    $("#suspendButton").click(function(e){

                                        var reason = $('#suspend_reason').val();

                                        $.ajax({
                                            type:'post',
                                            url :url,
                                            data:{id:id,action:action,reason:reason},
                                            dataType:'json',
                                            success:function(data){
                                                if(data.status == true){
                                                    var title = data.title;
                                                    var msg = data.message;
                                                    toastr.options = {
                                                        positionClass : 'toast-top-left',
                                                        onclick:null
                                                    };

                                                    $('.modal').modal('hide');
                                                    var $toast = toastr['success'](msg,title);
                                                    $toastlast = $toast;

//                                            $tr.find('td').fadeOut(100,function () {
//                                                $tr.remove();
//                                            });

                                                    function pageRedirect() {
                                                        location.reload();
                                                    }
                                                    setTimeout(pageRedirect(), 2500);
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
                                    });
                                }

                            }

                        }
                    );
                })

            </script>

@endsection
