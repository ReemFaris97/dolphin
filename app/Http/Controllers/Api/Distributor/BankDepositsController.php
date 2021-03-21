<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\BankDepositsResource;
use App\Http\Resources\Distributor\CarsResource;
use App\Http\Resources\Distributor\ProductsResource;
use App\Http\Resources\Distributor\ReportsResource;
use App\Http\Resources\Distributor\SettingResources;
use App\Models\AccountingSystem\AccountingSetting;
use App\Models\BankDeposit;
use App\Models\DistributorRoute;
use App\Models\RouteTripReport;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DailyReportOperation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class BankDepositsController extends Controller
{
    use ApiResponses;


    public function index()
    {


        if (request('from') != null && \request('to')) {
            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));
            $BankDeposits = BankDeposit::where('user_id', auth()->id())->whereBetween('deposit_date', [$from, $to])->orderBy('deposit_date', 'DESC')
                ->paginate($this->paginateNumber);
        } else {
            $BankDeposits = BankDeposit::where('user_id', auth()->id())->orderBy('deposit_date', 'DESC')
                ->paginate($this->paginateNumber);

        }

        return $this->apiResponse(new BankDepositsResource($BankDeposits));
    }

    public function store(Request $request)
    {

        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'bank_id' => 'required_if:type,==,bank_transaction|integer|nullable|exists:banks,id',
            'deposit_number' => "required_if:type,==,bank_transaction|nullable|string|max:191",
//            'deposit_date' => "required|date",
            'image' => "required||mimes:jpg,jpeg,gif,png",
        ];
        $validation = $this->apiValidation($request, $rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $requests = $request->except('image');
        if ($request->hasFile('image') && $request->image != null) {

            $requests['image'] = saveImage($request->image, 'photos');
        }
        $requests['deposit_date'] = Carbon::parse($request['deposit_date']);
        BankDeposit::create($requests);

        return $this->apiResponse('تم الايداع بنجاح');
    }


}
