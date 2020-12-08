<table class="table table-striped- table-bordered table-hover table-checkable" >
    <thead>
    <tr>
        <th> اسم العميل        </th>
        <th>كود الفاتورة
        </th>
        <th> الحالة</th>
        <th>تاريخ الزيارة
        </th>
        <th>الاعدادات
        </th>
    </tr>
    </thead>
    <tbody>
  <tr>
    <td>    
    <a href="{{route('distributor.clients.show',$trips->trip->client->id)}}" class="btn btn-info"> {{$trips->trip->client->name}}</a>
    </td>
    <td>{{$trips->trip_report->invoice_number}}</td>
    <td>
        @if($trips->type=='accept')
      <span style="color: green"> مقبول</span>
        @elseif($trips->type=='refuse')
        <span style="color: red"> مرفوض</span>
        @endif
    </td>
    <td>{{$trips->created_at->toDateString()}}
    </td>
    <td><!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
المزيد          </button>
          </td>

  </tr>
  
    </tbody>
  
</table>

<hr>
<h3> قائمه الاصناف</h3>
<table class="table table-striped- table-bordered table-hover table-checkable" >
    <thead>
    <tr>
        <th> اسم الصنف</th>
        <th>الموجود</th>
        <th> المباع</th>
        <th>التصريف</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
  <tr>
    <th>{{$product['product_name']}}        </th>
    <th>{{$product['exists']}}    </th>
    <th>
        {{$product['sells']}} 
    </th>
    <th>{{$product['selling']}} 
    </th>

  </tr>
  @endforeach
    </tbody>
   
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">التفاصيل</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-striped- table-bordered table-hover table-checkable" >
                <thead>
                <tr>
                    <th> اسم العميل  </th>
                    <th> جوال العميل</th>
                    <th> اسم المسار</th>
                    <th> اسم المندوب
                    </th>
                   
                </tr>
                </thead>
                <tbody>
              <tr>
                <td>{{$trips->trip->client->name}}
                
                </td>
                <td>{{$trips->trip->client->phone}}</td>
                <td>{{$trips->trip->route->name}}</td>
                <td>{{$trips->trip->route->user->name}}</td>
             
              </tr>
              
                </tbody>
              
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>