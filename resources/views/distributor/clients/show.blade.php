@extends('distributor.layouts.app')

@section('breadcrumb') @php($breadcrumbs=['عرض بيانات العميل'=>'/distributor',$client->id ])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    عرض بيانات العميل {!!$client->name!!}
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


        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                    aria-controls="general" aria-selected="true">
                    General
                </a>
                {{-- @if($client->payment_type=='deffered') --}}
                <a class="nav-item nav-link" id="invocies-tab" data-toggle="tab" href="#invocies" role="tab"
                    aria-controls="invocies" aria-selected="false">
                    Invoices
                </a>
                {{-- @endif --}}
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                    <thead>
                        <tr>
                            <th> المعلومه</th>
                            <th> القيمه</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>صوره العميل</td>
                            <td>
                                @if($client->image)
                                <img src="{!!asset($client->image)!!}" width="100" height="100" />
                                @else
                                لا توجد صوره
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>صوره المندوب</td>

                            <td>
                                @if($client->user->image)
                                <img src="{!!asset($client->user->image)!!}" width="100" height="100" />
                                @else
                                لا توجد صوره
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td> كود العميل </td>
                            <td>{{$client->code}}</td>
                        </tr>

                        <tr>
                            <td>السجل الضريبى </td>
                            <td>{{$client->tax_number}}</td>
                        </tr>

                        <tr>
                            <td>الشريحة </td>
                            <td>{{optional($client->client_class)->name}}</td>
                        </tr>
                        <tr>
                            <td> اسم العميل</td>
                            <td>{{$client->name}}</td>
                        </tr>

                        <tr>
                            <td> جوال العميل </td>
                            <td>{{$client->phone }}</td>
                        </tr>


                        <tr>
                            <td>
                                تاريخ ووقت الإضافة
                            </td>
                            <td>{{$client->created_at }}</td>
                        </tr>

                        <tr>
                            <td>
                                الحالة

                            </td>
                            <td>{{$client->is_active?'معتمد':'غير معتمد' }}</td>
                        </tr>
                        <tr>
                            <td>
                                اسم المسار

                            </td>
                            <td>{{$client->route->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                اسم المندوب

                            </td>
                            <td>{{$client->user->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                اسم المتجر

                            </td>
                            <td>{{$client->store_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                الملاحظات

                            </td>
                            <td>{{$client->notes }}</td>
                        </tr>
                    </tbody>
                </table>
                @include('distributor.clients._map', ['lat'=>$client->lat,'lng'=>$client->lng])

            </div>
            {{-- @if($client->payment_type=='deffered') --}}

            <div class="tab-pane fade" id="invocies" role="tabpanel" aria-labelledby="invocies-tab">

                <table class="table table-bordered  table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ الفاتورة</th>
                            <th>القيمه</th>
                            <th>تاريخ السداد</th>
                            <th>الاعدادت</th>
                        </tr>
                    </thead>
                    {{-- fetch('/contact', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.formData)
            })
			.then(() => {
				this.message = 'Form sucessfully submitted!'
			})
			.catch(() => {
				this.message = 'Ooops! Something went wrong!'
			})
		} --}}
                    <tbody x-data='{
                        invoices:@json($client->invoices->each->append(' invoice_number')),
                        format_date:function(date,format="YYYY-MM-DD" ){ return moment(date).format(format) },
                        pay_invoice_request(invoice_id){
                            let app=this
                            fetch("/distributor/invoice/pay",
                             {
                                  method: "POST" ,
                                   headers:{
                                        "Content-Type" : "application/json" ,
                                        "X-CSRF-TOKEN" :$("meta[name=csrf-token]").attr("content")
                                                },
                          body: JSON.stringify({invoice_id}) })
                        .then((data)=> {
                        return data.json()
                        }).then(data=>{
                        app.invoices= app.invoices.map((invoice)=>{

                        if(invoice.id===invoice_id){

                            return data;
                            }
                            return invoice;
                            })
                        })
                        .catch(() => {
                                this.message = "Ooops! Something went wrong!"
                             })
                        },
                        pay_invoice(invoice_id){
                            //TODO::add sweet alert to confirm before ajax request
                            this.pay_invoice_request(invoice_id);
                        }
                        }'>
                        {{-- @foreach($client->invoices as $invoice) --}}
                        <template x-for="(invoice,index) in invoices" :key="index">
                            <tr>
                                <td x-text="invoice.invoice_number"></td>
                                <td x-text="format_date(invoice.created_at)"></td>
                                <td x-text="invoice.cash"></td>
                                <td>
                                    <span x-show="invoice.paid_at!=null" x-text="format_date(invoice.paid_at)"></span>
                                </td>
                                <td>
                                    <button type="button" x-show="invoice.paid_at===null" class="btn btn-danger"
                                    @click.prevent="pay_invoice(invoice.id)">
                                <i class="fas fa-dollar-sign"></i>
                                </button>
                                </td>

                        </template>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                {{-- @dd($client->Invoices) --}}

            </div>
            {{-- @endif --}}
        </div>


    </div>
</div>


@endsection


@section('scripts')
@endsection
