<option selected disabled>  اختر</option>

@foreach($cars as $car)
    <option  value="{{$car->id}}">{{$car->name}}</option>
@endforeach
