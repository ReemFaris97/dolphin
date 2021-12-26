
<td>
    @if($row->created_at==$row->paid_at)
        <label class="btn btn-success"> تم السداد</label>
    @elseif($row->paid_at!=null && $row->created_at!=$row->paid_at)
        <label class="btn btn-success"> تم السداد </label>
    @elseif($row->paid_at==null)
        <label class="btn btn-danger">غير مسدده </label>

        <button type="button" class="btn btn-outline-danger btn-circle" data-toggle="modal" data-target="#pay-{{$row->id}}">
            <i  class="fa fa-coins"></i>
            سداد </button>


        <div class="modal fade" id="pay-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    {!!Form::open(
                        ['route' => ['distributor.bills.pay',$row->id] ,
                        'id'=>'pay-form'.$row->id,
                         'method' => 'post',
                         'x-data'=>"{
                             row:".$row->toJson().",
                             cash:null,
                             total:".$row->product_total().",
                             visa:null,
                               get is_equal_total() { return parseFloat(this.cash||0)+parseFloat(this.visa||0)==parseFloat(this.total) },
                 }"

                         ]) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تسديد فاتوره (بقيمة {{$row->product_total()}}ريال ) </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<span class="badge badge-danger p-1" style="font-size: initial;" x-show="!is_equal_total">
يجب ان يكون المجموع مساوى لقيمة الفاتورة

</span>
                        <div class="m-portlet__body a-smaller-input-wrapper">
                            <div class="form-group ">
                                <label>الكاش</label>
                                {!! Form::number('cash',null,['class'=>'form-control m-input','placeholder'=>'الكاش' ,'x-model'=>'cash'])!!}
                            </div>

                        </div>

                        <div class="m-portlet__body a-smaller-input-wrapper">
                            <div class="form-group ">
                                <label>شبكة</label>
                                {!! Form::number('visa',null,['class'=>'form-control m-input',   'placeholder'=>'شبكه',
                                'x-model'=>'visa'])!!}
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-dismiss="modal">اغلاق </button>
                        <button type="submit" class="btn btn-primary" x-bind:disabled="!is_equal_total">حفظ</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>


    @endif
</td>
