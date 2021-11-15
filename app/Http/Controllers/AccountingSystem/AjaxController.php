<?php

declare(strict_types=1);

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingColumnCell;

class AjaxController
{
    public function getcompanyBranches($company)
    {
        return AccountingCompany::query()
        ->find($company)
        ->branches()
        ->get(['name as label','id']);
    }
    public function getBranchStores($branch)
    {
        return AccountingBranch::query()
            ->find($branch)
            ->stores()
            ->get(['ar_name as label','id']);
    }
    public function getBranchFaces($branch)
    {
        return AccountingBranch::query()
        ->find($branch)
           ->faces()
            ->get(['name as label','id']);
    }
    public function getFaceColumns($face)
    {
        return AccountingBranchFace::query()
        ->find($face)
           ->columns()
            ->get(['name as label','id']);
    }
    public function getColumnCells($column)
    {
        return AccountingFaceColumn::query()
        ->find($column)
           ->cells()
            ->get(['name as label','id']);
    }
}
