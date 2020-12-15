<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
    <thead>
    <tr>
        <th>#</th>

        <th>الاسم</th>
        <th>رقم الحساب</th>

        <th class="noExport">الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banks as $bank)
        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$bank->name!!}</td>
            <td>{!!$bank->bank_account_number!!}</td>

{{--            <td>{!!$user->job!!}</td>--}}
{{--            <td>{!! chooseNationality($user->nationality)!!}</td>--}}
{{--            <td>{!!$user->company_name!!}</td>--}}
{{--            <td>{!!$user->type!!}</td>--}}

            <td>

                <a href="{!!route('supplier.banks.edit',$bank->id)!!}" class="btn btn-primary"> <i class="fas fa-pen"></i> تعديل</a>


{{--                --}}
                <form method="POST" action="{!!route('supplier.banks.destroy',$bank->id)!!}">
                    @csrf() @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>



            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
    <th>#</th>

<th>الاسم</th>
<th>رقم الحساب</th>

<th class="noExport">الاعدادت</th>
    </tr>
    </tfoot>
</table>
