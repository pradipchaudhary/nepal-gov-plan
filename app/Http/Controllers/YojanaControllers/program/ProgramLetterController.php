<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_advance;
use App\Models\YojanaModel\program\work_order;
use App\Models\YojanaModel\setting\term;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramLetterController extends Controller
{
    public function index($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('workOrder')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.programLetter.dashboard', [
            'reg_no' => $plan->reg_no,
            'plan' => $plan
        ]);
    }

    public function workOrderLetter($reg_no, $route)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.programLetter.search_work_order', [
            'route' => 'program.letter.' . $route,
            'plan' => $plan,
            'reg_no' => $reg_no
        ]);
    }

    public function workOrderLetterSubmit(Request $request)
    {
        if ($request->work_order_id == '') {
            toast("कार्यादेश नं अनिवार्य छ", "error");
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();


        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()->where('id', $request->work_order_id)->first();
        return view('yojana.programLetter.work_order_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'work_order' => $work_order
        ]);
    }

    public function printWorkOrderLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()->where('id', $request->work_order_id)->first();

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.programLetter.print_work_order_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'date' => $request->date_nep
        ]);
    }

    public function workOrderLetterTwoSubmit(Request $request)
    {
        if ($request->work_order_id == '') {
            toast("कार्यादेश नं अनिवार्य छ", "error");
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();


        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.programLetter.work_order_letter_two', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'work_order' => $work_order
        ]);
    }

    public function printWorkOrderLetterTwo(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();


        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.programLetter.print_work_order_letter_two', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'date' => $request->date_nep
        ]);
    }

    public function agreementLetter(Request $request)
    {
        if ($request->work_order_id == '') {
            toast("कार्यादेश नं अनिवार्य छ", "error");
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();


        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->with('listRegistrationAttribute.listRegistration', 'workOrderDetail.Staff')
            ->first();

        return view('yojana.programLetter.agreement_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'term' => term::query()->where('type_id', 0)->first()
        ]);
    }

    public function printAgreementLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->with('listRegistrationAttribute.listRegistration', 'workOrderDetail.Staff')
            ->first();

        return view('yojana.programLetter.print_agreement_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'term' => term::query()->where('type_id', 0)->first(),
            'date' => $request->date_nep
        ]);
    }

    public function peskiLetterDashboard($reg_no)
    {
        $program = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.programLetter.peskiLetter.peski_letter_dashboard', [
            'reg_no' => $program->reg_no,
            'program' => $program
        ]);
    }

    public function advanceLetter(Request $request)
    {
        if ($request->work_order_id == '') {
            toast("कार्यादेश नं अनिवार्य छ", "error");
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->whereHas('programAdvance')
            ->with('programAdvance', 'listRegistrationAttribute.listRegistration')
            ->first();

        if ($program == null || $work_order == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }


        return view('yojana.programLetter.peskiLetter.peski_agreement_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'work_order' => $work_order,
        ]);
    }

    public function printadvanceLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->whereHas('programAdvance')
            ->with('programAdvance', 'listRegistrationAttribute.listRegistration')
            ->first();

        if ($program == null || $work_order == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }


        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.programLetter.peskiLetter.print_peski_agreement_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'date' => $request->date_nep
        ]);
    }

    public function financialAdministrationLetter(Request $request)
    {
        if ($request->work_order_id == '') {
            toast("कार्यादेश नं अनिवार्य छ", "error");
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->whereHas('programAdvance')
            ->with('programAdvance', 'listRegistrationAttribute.listRegistration')
            ->first();

        if ($program == null || $work_order == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }


        return view('yojana.programLetter.peskiLetter.financial_administration_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'work_order' => $work_order,
        ]);
    }

    public function printFinancialAdministrationLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $program = plan::query()
            ->where('id', $request->program_id)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        $work_order = work_order::query()
            ->where('id', $request->work_order_id)
            ->whereHas('programAdvance')
            ->with('programAdvance')
            ->first();

        if ($program == null || $work_order == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }


        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.programLetter.peskiLetter.print_financial_administration_letter', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_order' => $work_order,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'date' => $request->date_nep
        ]);
    }
}
