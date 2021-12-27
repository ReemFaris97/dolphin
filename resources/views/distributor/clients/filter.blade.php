<div class="row">
    <div class="col-12 ">
        <form class="form-horizontal" method="get"
              action="{{route('distributor.clients.index')}}">

            <div class="form-group row ">
                <div class="col-12 col-md-3">
                    <label class="  control-label">اسم المندوب </label>
{{--                    <select name="user_id" id="user_id" class="form-control select2" multiple>--}}
{{--                        <option selected disabled>اختر المندوب  </option>--}}
{{--                        @foreach(\App\Models\User::all() as $user)--}}
{{--                            <option--}}
{{--                                value="{{$user->id}}" {{request('user_id') == $user->id ? 'selected': ''}}>{{$user->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                    {!! Form::select('user_id[]',users(), request('user_id'),['class' =>'form-control select2'.($errors->has('user_id') ? ' is-invalid' : null) ,'multiple' ]) !!}
                    @error('user_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">اسم المسار</label>
{{--                    <select name="route_id" id="route_id" class="form-control select2" multiple>--}}
{{--                        <option selected disabled>اختر  المسار  </option>--}}
{{--                        @foreach(\App\Models\DistributorRoute::all() as $route)--}}
{{--                            <option--}}
{{--                                value="{{$route->id}}" {{request('route_id') == $route->id ? 'selected': ''}}>{{$route->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                    {!! Form::select('route_id[]',routes(), request('route_id'),['class' =>'form-control select2'.($errors->has('route_id') ? ' is-invalid' : null) ,'multiple' ]) !!}
                    @error('route_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">شِريحة العميل  </label>
{{--                    <select name="class_id" id="class_id" class="form-control select2" multiple>--}}
{{--                        <option selected disabled>شِريحة العميل</option>--}}
{{--                        @foreach(\App\Models\ClientClass::all() as $class)--}}
{{--                            <option--}}
{{--                                value="{{$class->id}}" {{request('class_id') == $class->id ? 'selected': ''}}>{{$class->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                    {!! Form::select('class_id[]',classes(), request('class_id'),['class' =>'form-control select2'.($errors->has('class_id') ? ' is-invalid' : null) ,'multiple' ]) !!}
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
