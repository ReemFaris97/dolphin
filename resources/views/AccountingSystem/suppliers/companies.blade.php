@foreach ($row->companies as $company)
    <li>{{$company->company?->name}}</li>
@endforeach
