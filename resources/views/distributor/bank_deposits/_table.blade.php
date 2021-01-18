<!--begin: Datatable -->




<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>صوره الايداع</th>
        <th>رقم الايداع</th>
        <th>تاريخ الايداع</th>
        <th>اسم البنك</th>
        <th>اسم المندوب</th>
        <th>قيمه الايداع</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bank_deposits as $row)
        <tr>
            <td>{!!$loop->iteration!!}</td>

              <td><img src="{!!asset($row->image)!!}" height="100" width="100"/></td>
              <td>{{$row->deposit_number}}</td>
              <td>{{$row->deposit_date}}</td>
              <td>{{$row->bank->name}}</td>
              <td>{{$row->distributor->name}}</td>
              <td>{{$row->amount}}</td>

            <td>
                <a href="#"  onclick="Delete({{$row->id}})"  data-original-title="حذف" class="btn btn-danger btn-circle"><i  class="fa fa-trash"></i> حذف</a>
                {!!Form::open( ['route' => ['distributor.bank-deposits.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>

        <th>صوره الايداع</th>
        <th>رقم الايداع</th>
        <th>تاريخ الايداع</th>
        <th>اسم البنك</th>
        <th>اسم المندوب</th>
        <th>قيمه الايداع</th>
        <th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
