@if ($row->is_active==0)
    <span class="lable lable-danger">غير معتمد</span>
    <a href="{{route("distributor.client.active",$row->id)}}" class="btn btn-success btn-circle">
        <i class="fas fa-check"></i>
    </a>

@else
    <span class="lable lable-success"> معتمد</span>
    <a href="{{route("distributor.client.dis_active",$row->id)}}" class="btn btn-danger btn-circle">
        <i class="fas fa-times"></i>
    </a>
@endif
