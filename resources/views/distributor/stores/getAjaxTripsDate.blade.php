<option selected disabled value="">  اختر</option>

@foreach($cars as $car)
    <option>{{$car->name}}</option>
@endforeach
