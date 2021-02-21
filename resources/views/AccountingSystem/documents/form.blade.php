@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--<div class="form-group col-md-6 pull-left">--}}
{{--    <label>اسم المسمى الوظيفى   </label>--}}
{{--    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم  المسمى الوظيفى   ','required'])!!}--}}
{{--</div>--}}



    <div class="form-group col-sm-6 pull-left">
        <label for="document_name">{{__('trans.document_name')}}</label>
        <input type="text" name="document_name" value="{{isset($document) ? $document->document_name : old('document_name')}}" id="document_name" class="form-control">
    </div>
    <div class="form-group col-sm-6">
        <label for="document_number">{{__('trans.document_number')}}</label>
        <input type="text" name="document_number" value="{{isset($document) ? $document->document_number : old('document_number')}}" id="document_number" class="form-control">
    </div>
    <div class="form-group col-sm-12">
        <label for="target">{{trans('trans.'.$type.'_target')}}</label>
        <select name="documentable_id" id="target" class="form-control">
            @foreach ($targets as $target)
                <option value="{{$target->id}}" {{isset($document) && $document->documentable_id == $target->id ? 'selected' : ''}}>{{$target->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-6">
        <label for="start_date">{{__('trans._start_date')}}</label>
        <input type="date" name="start_date" id="start_date" value="{{isset($document->start_date) && !request()->has('parent') ? $document->start_date->format('Y-m-d') : old('start_date')}}" class="form-control">
    </div>
    <div class="form-group col-sm-6">
        <label for="end_date">{{__('trans._end_date')}}</label>
        <input type="date" name="end_date" id="end_date" value="{{isset($document->end_date) && !request()->has('parent') ? $document->end_date->format('Y-m-d') : old('end_date')}}" class="form-control">
    </div>
    <div class="form-group col-sm-12">
        <label for="document">{{__('trans.the_document')}}</label>
        <input type="file" name="document" id="document" class="form-control">
        @if(isset($document) && !request()->has('parent'))
            <a href="{{$document->url}}" target="_blank">{{__('trans.show_file')}}</a>
        @endif
    </div>
    <input type="hidden" name="paret" value="{{request('parent') ?? 0}}">
    <div class="form-group col-sm-12">
        <label for="notes">{{__('trans.notes')}}</label>
        <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{isset($document) ? $document->notes : old('notes')}}</textarea>
    </div>




<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();


    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
