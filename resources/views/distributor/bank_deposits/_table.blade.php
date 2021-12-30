<!--begin: Datatable -->




<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>صوره الايداع</th>
        <th> النوع</th>
        <th>تاريخ الايداع</th>
        <th>اسم البنك</th>
        <th>اسم المندوب</th>
        <th>قيمه الايداع</th>
        <th>  التاريخ من</th>
        <th>  التاريخ الى </th>
        <th>    جالة الايداع </th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bank_deposits as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>

              <td>
                  <img src="{!!asset($row->image)!!}" height="100" width="100"/>
              </td>
              <td>{{$row->type=='bank_transaction'? 'تحويل بنكى':'مبلغ مباشر'}}</td>
              <td>{{$row->deposit_date->toDateString()}}</td>
              <td>{{$row->bank->name}}</td>
              <td>{{$row->distributor->name}}</td>
              <td>{{$row->amount}}</td>
              <td>{{optional($row->from)->toDateString()  }}</td>
              <td>{{optional($row->to)->toDateString()  }}</td>
<td>
    <form
        action="{{ route('distributor.bank-deposits.confirm', ['id' => $row->id]) }}"
        style="display: inline;"
        method="post">@csrf
        <button type="submit" {{$row->confirmed==0 ? '':'disabled'}} class="btn-icon waves-effect text-white
                {{ $row->confirmed == 0 ? 'btn btn-sm btn-success' : 'btn btn-sm btn-dark ' }}">
            {{$row->confirmed == 0 ? '  تأكيد ' : ' تم التاكيد' }}
        </button>
    </form>
</td>
            <td>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.bank-deposits.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>

</table>
