<table class="table" style="color:white;">
    <th> اسم الموظف</th>
    <th> المسمى الوظيفى</th>
    <th>   المكافأة</th>
    <tbody>
    @foreach ($users as $user)
    <tr class="parent-tr" style="color:white;">
        <td>{{$user->name}}</td>
        <td>{{optional($user->title)->name}}</td>
        <td><input type="number"  name="bouns[{{$user->id}}]"   class="form-control bouns" placeholder="ادخل المكافأة"></td>
    </tr>
    </tbody>
    @endforeach
</table>




