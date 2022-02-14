<?php

declare(strict_types=1);

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingStore;

class AjaxController
{
    public function getcompanyBranches(AccountingCompany $company)
    {
        return [
            "branches" => $company->branches()->get(["name as label", "id"]),
            "categories" => $company
                ->categories()
                ->get(["ar_name as label", "id"]),
        ];
    }

    public function getBranchStores(AccountingBranch $branch)
    {
        return AccountingStore::where(function ($q) use ($branch) {
            $q->where("model_type", AccountingBranch::class)->where(
                "model_id",
                $branch->id
            );
        })
            ->orWhere(function ($q) use ($branch) {
                $q->where("model_type", AccountingCompany::class)->where(
                    "model_id",
                    $branch->company_id
                );
            })
            ->get(["ar_name as label", "id"]);
        return AccountingBranch::query()
            ->find($branch)
            ->stores()
            ->get(["ar_name as label", "id"]);
    }

    public function getBranchFaces($branch)
    {
        return AccountingBranch::query()
            ->find($branch)
            ->faces()
            ->get(["name as label", "id"]);
    }
    public function getFaceColumns($face)
    {
        return AccountingBranchFace::query()
            ->find($face)
            ->columns()
            ->get(["name as label", "id"]);
    }
    public function getColumnCells($column)
    {
        return AccountingFaceColumn::query()
            ->find($column)
            ->cells()
            ->get(["name as label", "id"]);
    }
}
