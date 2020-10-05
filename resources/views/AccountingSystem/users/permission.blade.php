<label> عرض الصلاحيات :</label>
  @foreach($permissions as $permission)
      <label class="label label-success">
   {{ $permission->name }}
      </label>
    @endforeach


