<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\deduction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramFinalPaymentController extends Controller
{
    public function index($reg_no): View
    {
        $program = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        return view('yojana.program.bhuktani.program_final_payment', [
            'program' => $program,
            'reg_no' => $reg_no,
            'deductions' => deduction::query()->get(),
            'remain_amount' => ($program->grant_amount - $program->workOrder->sum('municipality_amount'))
        ]);
    }
}
