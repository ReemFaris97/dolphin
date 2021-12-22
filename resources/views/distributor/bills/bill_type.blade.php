<td>
    @if($row->created_at==$row->paid_at)
        <label class="btn btn-success"> كاش</label>
    @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
        <label class="btn btn-danger"> أجل مسددة </label>
    @elseif($row->paid_at==null)
        <label class="btn btn-danger"> أجل</label>
    @endif
</td>
