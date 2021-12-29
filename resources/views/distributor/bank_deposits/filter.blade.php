<div class="row">
    <div class="col-12 ">
        <form class="form-horizontal" method="get"
              action="{{route('distributor.bank-deposits.index')}}">

            <div class="form-group row ">
                <div class="col-12 col-md-3">
                    <label class="  control-label">حالة الايداع </label>
                    <select name="confirmed" id="confirmed" class="form-control" >
                        <option selected disabled>اختر الحالة  </option>
                            <option value="0" {{request('confirmed') == '0' ? 'selected': ''}}>غير مؤكدة</option>
                            <option value="1" {{request('confirmed') == '1' ? 'selected': ''}}> مؤكدة</option>
                    </select>
                    @error('confirmed')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">من تاريخ  </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                    @error('from')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="  control-label">  الى تاريخ  </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                    @error('to')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-12 col-md-2">
                    <label class="control-label" > الغاء </label>
                    <a href="{{route('distributor.bank-deposits.index')}}"
                       class="form-control btn btn-dark text-white"> الغاء الفلتر</a>
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
