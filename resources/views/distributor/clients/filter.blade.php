<div class="row">
    <div class="col-12 ">
        <form class="form-horizontal" method="get"
              action="{{route('distributor.clients.index')}}">

            <div class="form-group row ">
                <div class="col-12 col-md-3">
                    <label class="  control-label">اسم المندوب </label>
                    {!! Form::select('user_id',users(), request('user_id'),['class' =>'form-control select2'.($errors->has('user_id') ? ' is-invalid' : null)  ]) !!}
                    @error('user_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">اسم المسار</label>
                    {!! Form::select('route_id',routes(), request('route_id'),['class' =>'form-control select2'.($errors->has('route_id') ? ' is-invalid' : null)  ]) !!}
                    @error('route_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">شِريحة العميل  </label>
                    {!! Form::select('class_id',classes(), request('class_id'),['class' =>'form-control select2'.($errors->has('class_id') ? ' is-invalid' : null)  ]) !!}
                    @error('class_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-12 col-md-2">
                    <label class="control-label" > الغاء </label>
                    <a href="{{route('distributor.clients.index')}}" class="form-control btn btn-dark text-white"> الغاء الفلتر</a>
                </div>
            </div>

            <div class="form-group row text-center">
                <button type="submit"
                        class="btn btn-success btn-block col-12 waves-effect waves-light ">
                    بحث
                </button>
            </div>

        </form>
    </div>
</div>
