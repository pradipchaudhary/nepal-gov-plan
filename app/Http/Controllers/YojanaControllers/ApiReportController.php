<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\plan;
use Illuminate\Http\Request;

class ApiReportController extends Controller
{
    public function plan(Request $request)
    {
        $fiscal_id = getCurrentFiscalYear(true)->id;
        $ward_condition = isset($request->ward_no) ? ($request->ward_no == 0 ? true : ($request->ward_no == '' ? false : true)) : false;
        $reg_no_condition = isset($request->reg_no) ? ($request->reg_no == 0 ? true : ($request->reg_no == '' ? false : true)) : false;
        return response()->json(plan::query()
            ->with('wardDetail', 'budgetSourcePlanDetails.budgetSources', 'Parents.budgetSourcePlanDetails.budgetSources', 'mergePlan', 'planAllocation', 'kulLagat')
            ->when($request->type_id, function ($q) use ($request) {
                $q->where('type_id', config('YOJANA.' . $request->type_id));
            })
            ->when($request->type_of_allocation_id, function ($q) use ($request) {
                $q->where('type_of_allocation_id', $request->type_of_allocation_id);
            })
            ->when($ward_condition, function ($q) use ($request) {
                $q->where('ward_no', $request->ward_no);
            })
            ->when($reg_no_condition, function ($q) use ($request) {
                $q->where('reg_no', $request->reg_no);
            })
            ->where('fiscal_year_id', $fiscal_id)
            ->whereNull('plan_id')
            ->paginate(25));
    }
}
