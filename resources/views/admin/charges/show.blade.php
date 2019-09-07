@extends('admin.layouts.app')
@section('title')تفاصيل العهدة
@endsection

@section('header')
<link href="{!! asset('dashboard/assets/owl.carousel.min.css') !!}" rel="stylesheet"  type="text/css"/>
@endsection

@section('breadcrumb') @php($breadcrumbs=['العهد'=>'/charges','اضافه'=>'/charges/create'])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            @if($charge->destroyed_at == null)

            <div class="m-demo__preview  m-demo__preview--btn">
                @if(auth()->user()->hasPermissionTo('assign_charges'))
                    <a href="{{route('admin.charges.getAddLog',$charge->id)}}" style="color: #FFF;" type="button"
                       class="btn btn-primary">تحديث حالة</a>
                @endif
                @if(auth()->user()->id==$charge->worker_id)
                    <a href="{{route('admin.charges.getAddNotes',$charge->id)}}" style="color: #FFF;" type="button"
                       class="btn btn-success">إضافة ملاحظة</a>
                @endif
                {{--<a type="button" class="btn btn-success">Success</a>--}}
                {{--<a type="button" class="btn btn-info">Info</a>--}}
                {{--<a type="button" class="btn btn-warning">Warning</a>--}}
                {{--<a type="button" class="btn btn-danger">Danger</a>--}}
                {{--<a type="button" class="btn btn-link">Link</a>--}}
            </div>
                @endif
        </div>
    </div>


    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <label>الاسم</label>
                    <input type="text" disabled class="form-control m-input" value="{{$charge->name}}">
                </div>

                <div class="col-xs-4">
                    <label>الوصف</label>
                    <textarea disabled class="form-control m-input">{{$charge->description}}</textarea>
                </div>

                <div class="col-xs-4">
                    <label>الموظف</label>
                    <input type="text" disabled class="form-control m-input" value="{{$charge->worker->name}}">
                </div>


                <label> صور العهدة </label>
                <div class="col-xs-4">

                    @if(isset($charge->images))
                       					<div class="owl-carousel owl-theme">
                        @foreach($charge->images as $image)

<!--                            <img src="{!! url($image->image)!!}" width="250" height="250">-->
                       		<div class="item">
							<a class="the-user-img" href="{!! url($image->image)!!}" data-fancybox="user-img">
								<img src="{!! url($image->image)!!}" />
							</a>
						</div>

                        @endforeach
					</div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*--}}

    @if(auth()->user()->hasPermissionTo('view_assigned_charges'))
        <div class="m-portlet__head-tools">
            <h3>سجل تحديثات العهدة</h3>
        </div>

        <table class="table table-striped- table-bordered table-hover table-checkable">
            <thead>
            <tr>
                <th>#</th>
                <th>التحديث بواسطة</th>
                <th>التاريخ</th>
                <th>الموظف السابق</th>
                <th>الموظف الجديد</th>
                <th>الصور</th>
            </tr>
            </thead>
            <tbody>
            @foreach($charge->logs as $log)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$log->charge->supervisor->name}}</td>
                    <td>{{$log->created_at->format('Y-m-d')}}</td>
                    <td>{{$log->previousWorker->name??"احمد"}}</td>
                    <td>{{$log->worker->name}}</td>
                    <td>
<!--                        @foreach($log->images as $image)-->
                            <ul style="list-style: none;">
                                <li>
                                								@foreach($log->images as $image)
									<li class="img-list-wrapper">
										<a href="{{getimgWeb($image->image)}}" data-fancybox="li-im">
											<img src="{{getimgWeb($image->image)}}">
										</a>
									</li>
								 @endforeach

                            </ul>
<!--                        @endforeach-->
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    @endif
    {{--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*--}}
    <div class="m-portlet__head-tools">
        <h3>سجل الملاحظات</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable">
        <thead>
        <tr>
            <th>#</th>
            <th style="width: 400px;">الوصف</th>
            <th>الموظف</th>
            <th>تاريخ</th>
            <th>الصور</th>
            <th>الاعدادت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($charge->notes as $note)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$note->description}}</td>
                <td>{{$note->user->name}}</td>
                <td>{{$note->created_at->format('Y-m-d')}}</td>
                <td>
                      <ul class="table-images-wrapper" style="list-style: none;">
							@foreach($note->images as $image)
                            <li class="img-list-wrapper"> 
								<a href="{{getimgWeb($image->image)}}" data-fancybox="notesimg">
                                	<img src="{{getimgWeb($image->image)}}">
								</a>

                            </li>
                             @endforeach
                        </ul>
                   
                </td>
                <td>
                    @if($charge->destroyed_at == null)
                    @if(auth()->user()->hasPermissionTo('delete_charges'))
                        <form method="POST" action="{!!route('admin.notes.destroy',$note->id)!!}">
                            @csrf() @method('delete')
                            <button type="submit" class="btn btn-danger"
                                    onclick="if(!confirm('هل انت متاكد من حذف الملاحظه')) event.preventDefault() ">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        </form>
                        @endif
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>


@endsection


@section('owl')
<script src="{!! asset('dashboard/assets/owl.carousel.min.js') !!}"></script>
<script>
	$('.owl-carousel').owlCarousel({
    rtl:true,
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>

@endsection
