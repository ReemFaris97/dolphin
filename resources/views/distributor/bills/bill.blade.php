@extends('distributor.layouts.app')

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        صور{!!$bill->invoice_number!!}
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
                    <td>صور قبل الجرد</td>
                    <td>
                        <div class="flex ">
                        @forelse($bill->inventory->images??[] as $image)
                            <a href="{!!asset($image->image)!!}" data-fancybox="inventory" class="justify-content-start mx-2">

                                <img src="{!!asset($image->image)!!}" width="100" height="100" />
                            </a>

                        @empty
                            لا توجد صور
                        @endforelse
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>صور بعد الجرد</td>

                    <td>
                        <div class="flex ">

                        @forelse($bill->images as $image)
                            <a class="justify-content-start mx-2" href="{!!asset($image->image)!!}" data-fancybox="inventory">

                                <img src="{!!asset($image->image)!!}" width="100" height="100" />
                            </a>

                        @empty
                            لا توجد صور
                        @endforelse
                        </div>
                    </td>
                </tr>


                </tbody>
            </table>

        </div>
    </div>


@endsection


@section('scripts')
@endsection
