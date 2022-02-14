<?php
namespace App\Traits;
use App\Events\ChargeCreated;
use App\Models\Charge;
use App\Models\User;

trait ChargeOperation
{
    /**
     * Register New Charge
     *
     * @param $request
     * @return mixed
     */
    public function RegisterCharge($request)
    {
        $inputs = $request->all();
        $charge = Charge::create($inputs);
        foreach ($request->images as $image) {
            $charge
                ->images()
                ->create(["image" => saveImage($image, "/images")]);
        }

        $worker = User::findOrFail($request->worker_id);
        $request["worker_id"] = $charge->worker_id;
        $request["previous_worker_id"] = $charge->worker_id;
        $request["charge_id"] = $charge->id;
        $request["type"] = "new";
        $this->AddChargeLog($request, $charge);
        event(new ChargeCreated($worker, $charge));
        return $charge;
    }

    public function UpdateCharge($charge, $request)
    {
        $inputs = $request->all();
        if (is_array($request->images)) {
            foreach ($request->images as $image) {
                $charge->images()->create(["image" => saveImage($image)]);
            }
        }

        return $charge->update($inputs);
    }

    /**
     * Register New Charge Log
     *
     * @param $request
     * @return mixed
     */
    public function AddChargeLog($request, $charge)
    {
        $request["previous_worker_id"] = $charge->worker_id;
        $log = $charge->logs()->create($request->all());
        if ($request->worker_id != $charge->worker_id) {
            $charge->update([
                "worker_id" => $request->worker_id,
            ]);
        }
        if ($request->images) {
            foreach ($request->images as $image) {
                $log->images()->create(["image" => saveImage($image)]);
            }
        }
        return $log;
    }
    /**
     * Register New Charge Notes
     *
     * @param $request
     * @return mixed
     */
    public function AddChargeNotes($request, $charge)
    {
        $request["user_id"] = auth()->user()->id;
        $note = $charge->notes()->create($request->all());
        foreach ($request->images as $image) {
            $note->images()->create(["image" => saveImage($image)]);
        }
        return $note;
    }
}
